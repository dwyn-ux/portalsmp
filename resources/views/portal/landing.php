<?php
/**
 * Portal landing page.
 * @var array $apps
 * @var array $categories
 * @var array $announcements
 * @var array $portalSettings
 * @var array $stats
 */
?>
<?php \App\Core\View::layout('main', 'portal.landing_content', get_defined_vars()); ?>
