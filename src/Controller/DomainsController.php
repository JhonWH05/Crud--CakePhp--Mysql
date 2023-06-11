<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Mailer\MailerAwareTrait;
use App\Model\Table\DomainsTable;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;


use Cake\Routing\Router;


/**
 * Domains Controller
 *
 * @property \App\Model\Table\DomainsTable $Domains
 * @method \App\Model\Entity\Domain[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DomainsController extends AppController
{
 

    use MailerAwareTrait;

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */

   
    public function index()
    {

  

        $domains = $this->paginate($this->Domains);

        $this->set(compact('domains'));

        //echo json_encode($domains);
        //exit();
    }

public function checkDomains()
{
    // Consulta dominios que no estan verificados desde la base de datos
    $uncheckedDomains = $this->Domains->find()
        ->where(['checked' => 0])
        ->toArray();

    // Crear una carpeta para almacenar los favicons si no existe
    $faviconFolder = new Folder(WWW_ROOT . 'img/favicons', true, 0755);

    // Recorrer los dominios no verificados
    foreach ($uncheckedDomains as $domain) {
        // Verifica si el dominio contiene un favicon
        $hasFavicon = $this->checkFavicon($domain->domain);

        if ($hasFavicon) {
            // Descargar y guardar el favicon
            $pathFavicon = $this->downloadFavicon($domain->domain, $faviconFolder);
            $domain->has_favicon = 1;
            $domain->path_favicon = $pathFavicon;
        } else {
            $domain->has_favicon = 0;
            $domain->path_favicon = null;
        }

        $domain->checked = 1;
        $this->Domains->save($domain);
    }

    $this->Flash->success(__('Se ha completado la verificación de dominios.'));
    return $this->redirect(['action' => 'index']);
}

private function checkFavicon($domain)
{
    // contruccion de  URL para verificar el favicon del dominio
    $faviconUrl = $domain . '/favicon.ico';

    // Realizar una solicitud HEAD al faviconUrl para comprobar su existencia
    $client = new Client();
    try {
        $response = $client->head($faviconUrl);
        // Verificar si la solicitud fue exitosa (código de estado 200)
        return $response->getStatusCode() === 200;
    } catch (\Exception $e) {
        return false; // El favicon no existe
    }
}

private function downloadFavicon($domain, $faviconFolder)
{
    // Construir la URL del favicon del dominio
    $faviconUrl = $domain . '/favicon.ico';

    // Descargar el favicon 
    $client = new Client();
    $response = $client->get($faviconUrl);

    // Generar un nombre de archivo único para el favicon
    $filename = time() . '.ico';

    // Ruta completa para guardar el favicon en la carpeta de favicons
    $fullPath = $faviconFolder->path . DS . $filename;

    // Guardar el contenido del favicon en el archivo
    $file = new File($fullPath, true, 0644);
    $file->write($response->getBody()->getContents());
    $file->close();

  
    return 'img/favicons/' . $filename;
}





    /**
     * View method
     *
     * @param string|null $id Domain id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $domain = $this->Domains->get($id, [
            'contain' => [],
        ]);

       $this->set(compact('domain'));

    }

  
    

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $domain = $this->Domains->newEmptyEntity();
        if ($this->request->is('post')) {
            $domain = $this->Domains->patchEntity($domain, $this->request->getData());
            if ($this->Domains->save($domain)) {
                $this->Flash->success(__('The domain has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The domain could not be saved. Please, try again.'));
        }
        $this->set(compact('domain'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Domain id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $domain = $this->Domains->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $domain = $this->Domains->patchEntity($domain, $this->request->getData());
            if ($this->Domains->save($domain)) {
                $this->Flash->success(__('The domain has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The domain could not be saved. Please, try again.'));
        }
        $this->set(compact('domain'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Domain id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $domain = $this->Domains->get($id);
        if ($this->Domains->delete($domain)) {
            $this->Flash->success(__('The domain has been deleted.'));
        } else {
            $this->Flash->error(__('The domain could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
