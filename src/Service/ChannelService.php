<?php

namespace App\Service;

use Sylius\Component\Channel\Model\ChannelInterface;
use Sylius\Component\Channel\Repository\ChannelRepositoryInterface;

class ChannelService
{
    const DEFAULT_CHANNEL = 'FASHION_WEB';
    const GERMAN_CHANNEL = 'FASHION_WEB_GERMAN_STORE';

    private ChannelRepositoryInterface $channelRepository;

    /**
     * @param ChannelRepositoryInterface $channelRepository
     */
    public function __construct(ChannelRepositoryInterface $channelRepository)
    {
        $this->channelRepository = $channelRepository;
    }

    public function default(): ChannelInterface
    {
        return $this->channelRepository->findOneByCode(self::DEFAULT_CHANNEL);
    }

    public function germany(): ChannelInterface
    {
        $channel = $this->channelRepository->findOneByCode(self::GERMAN_CHANNEL);

        if(null === $channel) {
            return $this->default();
        }

        return $channel;
    }

}
