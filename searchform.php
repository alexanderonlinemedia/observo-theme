<?php
/**
 * The template for displaying search forms
 *
 * @package observo
 */
?>
    <form method="get" class="search-form" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
        <input type="text" class="field" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" id="s" /><button type="submit" class="submit" name="submit" id="searchsubmit"/><div class="fa fa-search"></div></button>
    </form>