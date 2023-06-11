<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\Cake\Datasource\EntityInterface> $domains
 */
?>
<div class="domains index content">
    <?= $this->Html->link(__('New Domain'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <?= $this->Html->link('Revisar dominios', ['action' => 'checkDomains'], ['class' => 'button']) ?>

    <h3><?= __('Domains') ?></h3>
    <div class="domains-table">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('domain') ?></th>
                    <th><?= $this->Paginator->sort('checked') ?></th>
                    <th><?= $this->Paginator->sort('has_favicon') ?></th>
                    <th><?= $this->Paginator->sort('path_favicon') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($domains as $domain): ?>
                <tr>
                    <td><?= $this->Number->format($domain->id) ?></td>
                    <td><?= h($domain->domain) ?></td>
                <td><?= $domain->checked ? 'Sí' : 'No' ?></td>
                <td>
                    <?php if ($domain->has_favicon):   ?>
                         
                        <img src="<?= h($domain->path_favicon) ?>" alt="Favicon"> 
                        
                    <?php else: ?>
                        -
                    <?php endif; ?>
                </td>
                <td>
                <?php if ($domain->has_favicon): ?>
                    <?= $this->Html->link($domain->path_favicon, $domain->path_favicon) ?>
                <?php else: ?>
                    -
                <?php endif; ?>
            </td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $domain->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $domain->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $domain->id], ['confirm' => __('Are you sure you want to delete # {0}?', $domain->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
