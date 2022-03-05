<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Webflix
 */

?>

	<!--     start Footer Section   -->

    <footer id="tm-footer" class="uk-block uk-block-secondary uk-block-small ">
        <div class="uk-container-center uk-container">
            <div class="uk-grid">
                <div class="uk-width-medium-3-10">
                    <div class="copyright-text">&copy; 2016 <span class="uk-text-bold">Webflix</span> - Streaming Media Theme
                    </div>
                </div>
                <div class="uk-width-medium-5-10">
                    <ul class="uk-subnav ">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">FAQ's</a></li>
                        <li><a href="#">Terms & Conditions</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Contact Us</a></li>
                    </ul>
                </div>
                <div class="uk-width-medium-2-10">
                    <div class=" uk-float-right">
                        <ul class="uk-subnav">
                            <li>
                                <a href="#" class="uk-icon-hover uk-icon-medium uk-icon-facebook-square"></a>
                            </li>
                            <li>
                                <a href="#" class="uk-icon-hover uk-icon-medium uk-icon-twitter"></a>
                            </li>
                            <li>
                                <a href="#" class="uk-icon-hover uk-icon-medium uk-icon-instagram"></a>
                            </li>
                            <li>
                                <a href="#" class="uk-icon-hover uk-icon-medium uk-icon-pinterest"></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!--     start Offcanvas Menu   -->

    <div id="offcanvas" class="uk-offcanvas">
        <div class="uk-offcanvas-bar">
            <div class="uk-panel">
                <form class="uk-search">
                    <input class="uk-search-field" type="search" placeholder="Buscar...">
                </form>

            </div>
            <ul class="uk-nav uk-nav-offcanvas uk-nav-parent-icon" data-uk-nav>

                <li class="uk-parent">
                    <a href="#">Categorías</a>
                    <ul class="uk-nav-sub">
                        <li><a href="full-width.html">Acción</a></li>
                        <li><a href="full-width.html">Comedia</a></li>
                        <li><a href="full-width.html">Drama</a></li>
                        <li><a href="full-width.html">Suspenso</a></li>
                    </ul>
                </li>
                <li class="uk-nav-divider"></li>

            </ul>
            <div class="uk-panel uk-text-center">
                <li class="uk-nav-header">Pages</li>
                <li><a href=""> Home</a></li>
                <li><a href=""> FAQ's</a></li>
                <li><a href=""> Terms & Conditions</a></li>
                <li><a href=""> Privacy Policy</a></li>
                <li><a href=""> Contact Us</a></li>
                <ul class="uk-subnav">
                    <li>
                        <a href="#" class="uk-icon-hover uk-icon-medium uk-icon-facebook-square"></a>
                    </li>
                    <li>
                        <a href="#" class="uk-icon-hover uk-icon-medium uk-icon-twitter"></a>
                    </li>
                    <li>
                        <a href="#" class="uk-icon-hover uk-icon-medium uk-icon-instagram"></a>
                    </li>
                    <li>
                        <a href="#" class="uk-icon-hover uk-icon-medium uk-icon-pinterest"></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!--     ./ Offcanvas Menu   -->

    <script src="https://cdn.jsdelivr.net/npm/@tarekraafat/autocomplete.js@10.2.6/dist/autoComplete.min.js"></script>

<?php wp_footer(); ?>




</body>
</html>
