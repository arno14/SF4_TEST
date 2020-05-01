<?php

namespace App\Serializer;

use ApiPlatform\Core\Serializer\SerializerContextBuilderInterface;
use RuntimeException;
use Symfony\Component\HttpFoundation\Request;

/**
 * en passant le parametre "includes" dans l'url, on peut modifier les groupes de sérialization.
 */
class ContextBuilder implements SerializerContextBuilderInterface
{
    /**
     * @var SerializerContextBuilderInterface
     */
    private $baseContextBuilder;

    public function __construct(SerializerContextBuilderInterface $baseContextBuilder)
    {
        $this->baseContextBuilder = $baseContextBuilder;
    }

    /**
     * Creates a serialization context from a Request.
     *
     * @throws RuntimeException
     */
    public function createFromRequest(Request $request, bool $normalization, array $extractedAttributes = null): array
    {
        $context = $this->baseContextBuilder->createFromRequest($request, $normalization, $extractedAttributes);

        foreach (explode(',', $request->get('includes', '')) as $extraGroup) {
            $context['groups'][] = $extraGroup;
        }

        return $context;
    }
}
