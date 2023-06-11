<?php
declare(strict_types=1);

namespace App\Mailer;

use Cake\Mailer\Mailer;

class DefaultMailer extends Mailer
{
    public function domains_checked()
    {
        $this
            ->setTo('rafael.vega@bubok.es')
            ->setSubject('Revisión de dominios finalizada')
            ->deliver('Se han revisado todos los dominios.');
    }
}
