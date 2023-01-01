<?php

namespace SuperbThemesCustomizer\Modules\Navigation;

class NavigationMenu
{
    public function __construct()
    {
        if (!\has_nav_menu('menu-1')) {
            return;
        }
        $this->Render();
    }

    public function Render()
    {
?>
        <div class="center-main-menu">
            <?php
            wp_nav_menu(array(
                'theme_location'    => 'menu-1',
                'menu_id'            => 'primary-menu',
                'menu_class'        => 'pmenu'
            ));
            ?>
        </div>
<?php
    }
}
