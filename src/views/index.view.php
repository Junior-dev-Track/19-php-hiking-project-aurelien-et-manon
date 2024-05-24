<h2>List of products</h2>

<?php if (!empty($products)): ?>
    <ul>
        <?php foreach($products as $product): ?>
            <li>
                <a href="product?id_hikes=<?= $product['id_hikes'] ?>">
                    <?= $product['name'], $product['distance'] ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>