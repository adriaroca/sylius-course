<?php

namespace App\Context;

use App\Service\ChannelService;
use App\Service\LocaleService;
use Sylius\Component\Channel\Context\ChannelContextInterface;
use Sylius\Component\Channel\Model\ChannelInterface;

class LocaleChannelContext implements ChannelContextInterface
{
    private ChannelService $channelService;
    private LocaleService $localeService;

    /**
     * @param ChannelService $channelService
     * @param LocaleService $localeService
     */
    public function __construct(ChannelService $channelService, LocaleService $localeService)
    {
        $this->channelService = $channelService;
        $this->localeService = $localeService;
    }

    /**
     * @inheritDoc
     */
    public function getChannel(): ChannelInterface
    {
        if($this->localeService->germanSpeaker()) {
            return $this->channelService->germany();
        }

        return $this->channelService->default();
    }
}
