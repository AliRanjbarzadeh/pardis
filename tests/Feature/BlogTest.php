<?php

namespace Tests\Feature;

use App\DataTransferObjects\BlogDto;
use App\DataTransferObjects\SeoDto;
use App\Enums\TypeEnum;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Seo;
use App\Models\Tag;
use App\Services\BlogService;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class BlogTest extends TestCase
{
	use WithoutMiddleware;

	public function testStore()
	{
		$category = Category::where('type', '=', TypeEnum::Blog)->inRandomOrder()->first();

		$blogData = Blog::factory()->make();

		$seoData = Seo::factory()->make();

		$featureImage = UploadedFile::fake()->image("blog.png", 2000, 2000);

		$tags = Tag::inRandomOrder()->limit(rand(1, 10))->get();
		$tagsInput = $tags->pluck('id')->all();
		for ($i = 0; $i < rand(1, 5); $i++) {
			$tagsInput[] = fake()->name;
		}

		$dto = BlogDto::forTest($blogData, $category->id, $tagsInput, SeoDto::forTest($seoData), $featureImage);

		$this->assertNotNull(app(BlogService::class)->store($dto));
	}

	public function testUpdate()
	{
		$blog = Blog::with(['seo', 'tags', 'media', 'categories'])->first();

		$category = Category::where('type', '=', TypeEnum::Blog)->inRandomOrder()->first();

		$blogData = Blog::factory()->make();

		$seoData = Seo::factory()->make();

		$featureImage = UploadedFile::fake()->image("blog.png", 2000, 2000);

		$tagsInput = $blog->tags->isNotEmpty() ? $blog->tags->random(2)->pluck('id')->all() : [];
		for ($i = 0; $i < rand(1, 5); $i++) {
			$tagsInput[] = fake()->name;
		}

		$dto = BlogDto::forTest($blogData, $category->id, $tagsInput, SeoDto::forTest($seoData), $featureImage);

		$this->assertTrue(app(BlogService::class)->update($blog, $dto));
	}
}
