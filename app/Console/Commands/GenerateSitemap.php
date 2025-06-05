<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Models\TravelPackage;
use App\Models\Blog;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';
    protected $description = 'Generate the sitemap.xml file';

    public function handle()
    {
        $sitemap = Sitemap::create()
            ->add(Url::create('/'))
            ->add(Url::create('/travel-packages'))
            ->add(Url::create('/blogs'))
            ->add(Url::create('/contact'));

        // Tambahkan semua travel packages
        foreach (TravelPackage::all() as $package) {
            $sitemap->add(
                Url::create("/travel-packages/{$package->slug}")
            );
        }

        // Tambahkan semua blog
        foreach (Blog::all() as $blog) {
            $sitemap->add(
                Url::create("/blogs/{$blog->slug}")
            );
        }

        $sitemap->writeToFile(public_path('sitemap.xml'));

        $this->info('✅ Sitemap generated successfully.');
    }
}
