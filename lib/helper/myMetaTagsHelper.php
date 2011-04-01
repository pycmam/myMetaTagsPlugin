<?php
/**
 * Meta-теги страниц
 */

function include_page_metas()
{
    $context = sfContext::getInstance();
    $url = $context->getRequest()->getPathInfo();

    $pageMeta = myPageMetaTable::getInstance()->getByUrl($url);

    if ($pageMeta) {
        foreach (array('title', 'keywords', 'description') as $name) {
            if ($content = $pageMeta->get('meta_'.$name)) {
                $context->getResponse()->addMeta($name, $content, $replace = true);

                if ('title' == $name) {
                    $context->getResponse()->setTitle($content);
                }
            }
        }
    }

    include_title();
    include_metas();
}