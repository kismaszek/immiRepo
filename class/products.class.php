<?php 
	/**
	* 
	*/
	class products
	{
		
		function __construct()
		{
			$this->listProducts();
		}
		
		public function listProducts()
		{
			echo'<section id="products">
                <div class="product">
                    <figure>
                        <img src="product/termek-1.jpg">
                        <figcaption>Képaláírás</figcaption>
                        <span>5000 Ft</span>
                    </figure>
                    <div>
                        <h2>Termék neve</h2>
                    </div>
                    <form method="post" class="cart">
                        <input type="hidden" name="productID" value="1">
                        <input type="text" name="quantity"><span>db</span>
                        <button name="addToCart">Kosárba</button>
                    </form>
                </div>
                <div class="product">
                    <figure>
                        <img src="product/termek-1.jpg">
                        <figcaption>Képaláírás</figcaption>
                        <span>5000 Ft</span>
                    </figure>
                    <div>
                        <h2>Termék neve</h2>
                    </div>
                    <form method="post">
                        <input type="hidden" name="productID" value="2">
                        <input type="text" name="quantity"><span>db</span>
                        <button name="addToCart">Kosárba</button>
                    </form>
                </div>
                <div class="product">
                    <figure>
                        <img src="product/termek-1.jpg">
                        <figcaption>Képaláírás</figcaption>
                        <span>5000 Ft</span>
                    </figure>
                    <div>
                        <h2>Termék neve</h2>
                    </div>
                    <form method="post">
                        <input type="hidden" name="productID" value="3">
                        <input type="text" name="quantity"><span>db</span>
                        <button name="addToCart">Kosárba</button>
                    </form>
                </div>
            </section>';
		}
	}
?>