<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;

class DomainsTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('domains');
        $this->setDisplayField('domain');
        $this->setPrimaryKey('id');
    }

    public function findUncheckedDomains()
    {
        return $this->find()
            ->where(['checked' => 0])
            ->all();
    }


    public function markAsChecked($domainId)
    {
        $domain = $this->get($domainId);
        $domain->checked = 1;
        $this->save($domain);
    }

    public function markHasFavicon($domainId, $path)
    {
        $domain = $this->get($domainId);
        $domain->has_favicon = 1;
        $domain->path_favicon = $path;
        $this->save($domain);
    }
}
