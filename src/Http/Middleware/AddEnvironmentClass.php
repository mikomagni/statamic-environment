<?php

namespace MikoMagni\StatamicEnvironment\Http\Middleware;

use Closure;
use MikoMagni\StatamicEnvironment\ServiceProvider;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response;

class AddEnvironmentClass
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        // Only modify regular Response objects, not StreamedResponse or BinaryFileResponse
        if ($response->isSuccessful() &&
            !($response instanceof StreamedResponse) &&
            !($response instanceof BinaryFileResponse) &&
            $response->headers->get('Content-Type', '') !== 'application/json'
        ) {
            $content = $response->getContent();

            // Only process HTML content
            if ($content && strpos($content, '<body') !== false) {
                $env = env('APP_ENV', 'production');
                $envType = ServiceProvider::getEnvironmentType($env);

                // Add class to body tag - use both actual env name and type
                $content = preg_replace(
                    '/<body([^>]*)>/',
                    '<body$1 class="env_' . $env . ' env_type_' . $envType . '">',
                    $content
                );

                $response->setContent($content);
            }
        }

        return $response;
    }
}
