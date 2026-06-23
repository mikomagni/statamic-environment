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
                $env = config('app.env', 'production');
                $envType = ServiceProvider::getEnvironmentType($env);

                // Add classes to body tag - handle existing class attributes
                $envClasses = 'env_' . $env . ' env_type_' . $envType;

                $content = preg_replace_callback(
                    '/<body([^>]*)>/',
                    function ($matches) use ($envClasses) {
                        $attributes = $matches[1];

                        // Check if class attribute already exists
                        if (preg_match('/class=["\']([^"\']*)["\']/', $attributes, $classMatches)) {
                            // Append to existing classes
                            $existingClasses = $classMatches[1];
                            $attributes = preg_replace(
                                '/class=["\']([^"\']*)["\']/',
                                'class="$1 ' . $envClasses . '"',
                                $attributes
                            );
                        } else {
                            // Add new class attribute
                            $attributes .= ' class="' . $envClasses . '"';
                        }

                        return '<body' . $attributes . '>';
                    },
                    $content
                );

                $response->setContent($content);
            }
        }

        return $response;
    }
}
