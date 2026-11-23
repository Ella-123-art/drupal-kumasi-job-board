<?php

namespace Drupal\fjorge_blocks\Plugin\Block;

use Drupal\Core\Block\Attribute\Block;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\StringTranslation\TranslatableMarkup;

#[Block(
  id: "fjorge_latest_articles",
  admin_label: new TranslatableMarkup("Latest articles")
)]
class LatestArticlesBlock extends BlockBase {

  public function build() {
    $storage = \Drupal::entityTypeManager()->getStorage('node');
    $nids = $storage->getQuery()
      ->accessCheck(TRUE)
      ->condition('type', 'article')
      ->condition('status', 1)
      ->sort('created', 'DESC')
      ->range(0, 3)
      ->execute();

    $items = [];
    foreach ($storage->loadMultiple($nids) as $node) {
      $items[] = $node->toLink()->toRenderable();
    }

    return [
      '#theme' => 'item_list',
      '#title' => $this->t('Latest articles'),
      '#items' => $items,
      '#cache' => ['tags' => ['node_list']],
    ];
  }

}
