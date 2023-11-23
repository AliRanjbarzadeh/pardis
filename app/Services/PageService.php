<?php

namespace App\Services;

use App\DataTransferObjects\MetaDto;
use App\DataTransferObjects\PageDto;
use App\Enums\PageTypeEnum;
use App\Models\Page;
use Exception;
use Illuminate\Support\Facades\DB;

class PageService
{
	public function updateOrCreate(PageDto $dto): bool
	{
		$page = Page::where('type', '=', $dto->type)
			->with(['metas', 'seo', 'faqs', 'media', 'socialNetworks'])
			->first();

		if (is_null($page)) {
			return !is_null($this->store($dto));
		}

		return $this->update($page, $dto);
	}

	public function store(PageDto $dto): ?Page
	{
		try {
			DB::beginTransaction();

			$page = Page::create($dto->toArray());

			//metas
			if (!is_null($dto->metas)) {
				$page->addMetas($dto->metas);
			}

			//seo
			$page->saveSeoInformation($dto->seo);

			//faq
			if (!is_null($dto->faqs)) {
				$page->addFaqs($dto->faqs);
			}

			//featureImage
			if (!is_null($dto->featureImage)) {
				$page->upload($dto->featureImage, 'featureImage');
			}

			//social networks
			if (!is_null($dto->socialNetworks)) {
				$page->addSocialNetworks($dto->socialNetworks);
			}

			DB::commit();

			return $page;
		} catch (Exception $e) {
			DB::rollBack();
			return null;
		}
	}

	public function update(Page $page, PageDto $dto): bool
	{
		try {
			DB::beginTransaction();

			$page->update($dto->toArray());

			//metas
			if (!is_null($dto->metas)) {
				$dto->metas->map(function (MetaDto $dto) use ($page) {
					if ($page->hasMeta($dto->metaKey)) {
						$page->updateMeta($dto, $page->getMetaId($dto->metaKey));
					} else {
						$page->addMetas($dto);
					}
				});
			} else {
				$page->deleteMetas([]);
			}

			//seo
			$page->updateSeoInformation($dto->seo);

			//faq
			if (!is_null($dto->faqs)) {
				$page->updateFaqs($dto->faqs);
			}

			//featureImage
			$featureImage = $page->getMediumByName('featureImage');
			if (!is_null($dto->featureImage)) {
				if (!is_null($featureImage)) {
					$page->removeMedia($featureImage->id);
				}
				$page->upload($dto->featureImage, 'featureImage');
			}

			//social networks
			if (!is_null($dto->socialNetworks)) {
				$page->updateSocialNetworks($dto->socialNetworks);
			} else {
				$page->deleteSocialNetworks([]);
			}

			DB::commit();

			return true;
		} catch (Exception $e) {
			DB::rollBack();
			return false;
		}
	}

	public function find(PageTypeEnum $type, ?array $relations = null): ?Page
	{
		$page = Page::query()->where('type', '=', $type);

		if (!is_null($relations)) {
			$page->with($relations);
		}

		return $page->first();
	}
}