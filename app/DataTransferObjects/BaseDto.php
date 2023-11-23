<?php

namespace App\DataTransferObjects;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;

abstract class BaseDto
{
	public ?Collection $media = null;
	public ?Collection $contacts = null;
	public ?Collection $insurances = null;
	public ?Collection $workHours = null;
	public ?Collection $socialNetworks = null;
	public ?Collection $resumes = null;
	public ?Collection $faqs = null;

	public function setMedia(?array $media): static
	{
		if (!is_null($media)) {
			$this->media = collect(array_map(function (array $item) {
				return MediaDto::fromArray($item);
			}, $media));
		}
		return $this;
	}

	public function setContacts(array $contacts): static
	{
		if (count($contacts['title']) > 0 && (!empty($contacts['title'][0]) || !empty($contacts['value'][0]))) {
			$this->contacts = collect();
			foreach ($contacts['title'] as $key => $title) {
				$this->contacts->push(new ContactDto(
					id: intval(Str::replace('id-', '', $contacts['id'][$key])),
					contactTitle: $contacts['title'][$key],
					contactValue: $contacts['value'][$key],
				));
			}
		}

		return $this;
	}

	public function setInsurances(?array $insurances): static
	{
		if (!is_null($insurances)) {
			$this->insurances = collect(array_map(function ($item) {
				return new InsuranceItemDto(insuranceId: $item);
			}, $insurances));
		}

		return $this;
	}

	public function setWorkHours(array $workHours): static
	{
		if (count($workHours['title']) > 0 && !is_null($workHours['title'][0])) {
			$this->workHours = collect();
			foreach ($workHours['title'] as $key => $title) {
				$this->workHours->push(new WorkHourDto(
					title: $title,
					first: [
						'from' => $workHours['first']['from'][$key],
						'to' => $workHours['first']['to'][$key],
					],
					second: [
						'from' => $workHours['second']['from'][$key],
						'to' => $workHours['second']['to'][$key],
					]
				));
			}
		}
		return $this;
	}

	public function setSocialNetworks(array $socialNetworks): static
	{
		if (count($socialNetworks['title']) > 0 && !is_null($socialNetworks['title'][0])) {
			$this->socialNetworks = collect();
			foreach ($socialNetworks['title'] as $key => $title) {
				$this->socialNetworks->push(new SocialNetworkDto(
					socialNetworkTypeId: $socialNetworks['type_id'][$key],
					title: $title,
					address: $socialNetworks['address'][$key],
					id: intval(Str::replace('id-', '', $socialNetworks['id'][$key])),
				));
			}
		}

		return $this;
	}

	public function setResumes(array $resumes): static
	{
		if (count($resumes['title']) > 0 && !is_null($resumes['title'][0])) {
			$this->resumes = collect();
			foreach ($resumes['title'] as $key => $title) {
				$this->resumes->push(new ResumeDto(title: $title));
			}
		}

		return $this;
	}

	public function setFaqs(array $faqs): static
	{
		if (count($faqs['question']) > 0 && !empty($faqs['question'][0])) {
			$this->faqs = collect();
			foreach ($faqs['question'] as $key => $question) {
				$this->faqs->push(new FaqDto(
					id: intval(Str::replace('id-', '', $faqs['id'][$key])),
					question: $question,
					answer: $faqs['answer'][$key]
				));
			}
		}

		return $this;
	}
}