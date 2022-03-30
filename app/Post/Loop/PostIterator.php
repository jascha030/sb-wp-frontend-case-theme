<?php

declare(strict_types=1);

namespace Jascha030\WpFrontendCaseTheme\Post\Loop;

class PostIterator extends \WP_Query implements \Iterator
{
    private bool $keyByPostId;

    public function __construct($query = '')
    {
        $this->keyByPostId = false;

        parent::__construct($query);
    }

    final public function keyByPostId(bool $enabled = true): \Iterator
    {
        $this->keyByPostId = $enabled;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function current()
    {
        if (! isset($this->post)) {
            $this->the_post();
        }

        return $this->post;
    }

    /**
     * {@inheritDoc}
     */
    public function next()
    {
        return $this->next_post();
    }

    /**
     * {@inheritDoc}
     */
    public function key(): ?int
    {
        if (0 === $this->post_count) {
            return null;
        }

        return $this->keyByPostId
            ? $this->current_post
            : $this->post->ID;
    }

    /**
     * {@inheritDoc}
     */
    public function valid(): bool
    {
        return $this->have_posts();
    }

    /**
     * {@inheritDoc}
     */
    public function rewind(): void
    {
        $this->rewind_posts();
    }
}
