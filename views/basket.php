<div class="container">
    <?php if ($basket) : ?>
        <div class="basket">
            <div class="basketHeader">
                <div class="imgBasket"></div>
                <div class="productName">Название товара</div>
                <div class="quantityBasket">Колличество</div>
                <div class="priceBasket">Цена товара</div>
                <div class="deleteBasket"></div>
            </div>

            <div class="basketContent">
                <?php foreach ($basket as $product) : ?>
                    <div class="basketItem">
                        <img class="imgBasket" src="img/imgCatalog/<?= $product['img_prod'] ?>" alt="<?= $product["img"] ?>">
                        <div class="productName"><?= $product["name_product"] ?></div> <br>
                        <div class="quantityBasket"><?= $product["quantity"] ?></div><br>
                        <div class="priceBasket"><?= $product["price"] ?></div><br>
                        <div class="deleteBasket">
                            <a href="/?c=basket&a=buy&id=<?= $product["idProdBasket"] ?>" class="basketBtn">+</a>
                            <a href="/?c=basket&a=delete&id=<?= $product["idProdBasket"] ?>" class="basketBtn">-</a>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    <?php else : ?>
        <h2 class="clearBasket">Корзина пуста</h2>
    <?php endif; ?>

    <?php if (!empty($basket)) : ?>
        <div class="basketFooter">
            <div class="sum">Сумма : <span><?= $sumProduct ?></span></div>
        </div>
        <form class='btnOrder' action="/?c=basket&a=createOrder&$idorder=<?= $product['idprod'] ?>" method="post">
            <input hidden type="text" name="sumOrder" value="<?= $sumProduct ?>">
            <input type="submit" value="Оформить заказ">
        </form>
    <?php endif; ?>
</div>
