<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Page()
 * @method static static Blog()
 * @method static static Events()
 * @method static static Link()
 * @method static static Folder()
 */
final class ContentType extends Enum
{
    const Page = \App\Models\Website\Page::class;
//    const Blog = 'blog';
//    const Events = 'event';
//    const Link = 'link';
//    const Folder = 'folder';
}
