<h1>Listado de Dominios</h1>

<table>
    <thead>
        <tr>
            <th>Domain</th>
            <th>Revisado</th>
            <th>Favicon</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($domains as $domain): ?>
            <tr>
                <td><?= h($domain->domain) ?></td>
                <td><?= $domain->checked ? 'Sí' : 'No' ?></td>
                <td>
                    <?php if ($domain->has_favicon): ?>
                        <img src="<?= h($domain->path_favicon) ?>" alt="Favicon">
                    <?php else: ?>
                        -
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= $this->Form->postLink('Revisar dominios', ['action' => 'checkDomains'], ['confirm' => '¿Estás seguro?']) ?>
