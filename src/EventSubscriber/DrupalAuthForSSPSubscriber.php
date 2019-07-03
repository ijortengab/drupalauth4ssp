<?php

namespace Drupal\drupalauth4ssp\EventSubscriber;

use Drupal\Core\Url;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * DrupalAuth for SimpleSAMLphp event subscriber.
 */
class DrupalAuthForSSPSubscriber implements EventSubscriberInterface {

  /**
   * Kernel response event handler.
   *
   * @param \Symfony\Component\HttpKernel\Event\FilterResponseEvent $event
   *   Response event.
   */
  public function checkRedirection(FilterResponseEvent $event) {

    if ($event->getResponse() instanceOf RedirectResponse) {
      $response = $event->getResponse();
      $path = $response->getTargetUrl();
      $frontPage = Url::fromRoute('<front>')->setAbsolute()->toString();

      $isRedirectToFrontPage = ($path === $frontPage && $response->getStatusCode() === Response::HTTP_FOUND);
      $destination = &drupal_static('drupalauth4ssp_user_logout');
      if ($isRedirectToFrontPage && !empty($destination)) {
        $response->setTargetUrl($destination);
      }
    }
  }

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    return [
      KernelEvents::RESPONSE => ['checkRedirection'],
    ];
  }

}
