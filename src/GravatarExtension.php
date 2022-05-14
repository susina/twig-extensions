<?php declare(strict_types=1);

namespace Susina\TwigExtensions;

use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

/**
 * Class GravatarExtension
 */
class GravatarExtension extends AbstractExtension
{
    public const AVATAR_URL = "https://secure.gravatar.com/avatar";

    /**
     * @inheritdoc
     */
    public function getFilters(): array
    {
        return [
            new TwigFilter('gravatar', [$this ,'gravatarFilter']),
        ];
    }

    /**
     * @param string $email
     * @param array $params
     *
     * @return string
     */
    public function gravatarFilter(string $email, array $params = []): string
    {
        $resolver = new OptionsResolver();
        $this->configureOptions($resolver);

        $params = $resolver->resolve($params);
        $hash = md5(strtolower(trim($email)));

        return self::AVATAR_URL . "/$hash" . ($params !== [] ? "?" . http_build_query($params) : '');
    }

    /**
     * @psalm-suppress UnusedClosureParam $options param is mandatory even if unused.
     */
    private function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefined(['size', 'forcedefault', 'default', 'rating']);

        $resolver->setAllowedTypes('size', 'int');
        $resolver->setAllowedTypes('forcedefault', 'bool');
        $resolver->setAllowedTypes('default', 'string');
        $resolver->setAllowedTypes('rating', 'string');

        $resolver->setAllowedValues('size', fn (int $value): bool => $value >= 1 && $value <= 2048);
        $resolver->setAllowedValues('default', function (string $image): bool {
            return str_contains($image, '://') ?
                (bool) filter_var($image, FILTER_VALIDATE_URL) :
                in_array($image, ['404', 'mp', 'identicon', 'monsterid', 'wavatar', 'retro', 'robohash', 'blank'])
            ;
        });
        $resolver->addAllowedValues('rating', ['g', 'pg', 'r', 'x']);

        $resolver->setNormalizer('default', fn (Options $options, string $image): string => urlencode($image));
        $resolver->setNormalizer(
            'forcedefault',
            fn (Options $options, bool $value): string => $value === true ? 'y' : 'n'
        );
    }
}
