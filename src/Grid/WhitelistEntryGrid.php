<?php

/*
 * This file is part of the Sylius Force Customer Login package.
 *
 * (c) bitExpert AG
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace BitExpert\SyliusForceCustomerLoginPlugin\Grid;

use BitExpert\SyliusForceCustomerLoginPlugin\Model\WhitelistEntry;
use Sylius\Bundle\GridBundle\Builder\Action\CreateAction;
use Sylius\Bundle\GridBundle\Builder\Action\DeleteAction;
use Sylius\Bundle\GridBundle\Builder\Action\UpdateAction;
use Sylius\Bundle\GridBundle\Builder\ActionGroup\BulkActionGroup;
use Sylius\Bundle\GridBundle\Builder\ActionGroup\ItemActionGroup;
use Sylius\Bundle\GridBundle\Builder\ActionGroup\MainActionGroup;
use Sylius\Bundle\GridBundle\Builder\Field\StringField;
use Sylius\Bundle\GridBundle\Builder\Field\TwigField;
use Sylius\Bundle\GridBundle\Builder\Filter\StringFilter;
use Sylius\Bundle\GridBundle\Builder\GridBuilderInterface;
use Sylius\Bundle\GridBundle\Grid\AbstractGrid;
use Sylius\Bundle\GridBundle\Grid\ResourceAwareGridInterface;

class WhitelistEntryGrid extends AbstractGrid implements ResourceAwareGridInterface
{
    public function buildGrid(GridBuilderInterface $gridBuilder): void
    {
        $gridBuilder
            ->addField(
                StringField::create('label')
                    ->setLabel('bitexpert_sylius_forcelogin.ui.label'),
            )
            ->addField(
                StringField::create('urlRule')
                    ->setLabel('bitexpert_sylius_forcelogin.ui.urlRule'),
            )
            ->addField(
                TwigField::create('strategy', '@BitExpertSyliusForceCustomerLoginPlugin/Admin/Grid/Field/strategy.html.twig')
                    ->setLabel('bitexpert_sylius_forcelogin.ui.strategy'),
            )
            ->addField(
                TwigField::create('channels', '@BitExpertSyliusForceCustomerLoginPlugin/Admin/Grid/Field/channels.html.twig')
                    ->setLabel('bitexpert_sylius_forcelogin.ui.channels'),
            )
            ->addFilter(
                StringFilter::create('urlRule')
                    ->setLabel('bitexpert_sylius_forcelogin.ui.urlRule'),
            )
            ->addActionGroup(
                MainActionGroup::create(
                    CreateAction::create(),
                ),
            )
            ->addActionGroup(
                ItemActionGroup::create(
                    UpdateAction::create(),
                    DeleteAction::create(),
                ),
            )
            ->addActionGroup(
                BulkActionGroup::create(
                    DeleteAction::create(),
                ),
            )
        ;
    }

    public static function getName(): string
    {
        return 'bitexpert_sylius_forcelogin_whitelist_entry';
    }

    public function getResourceClass(): string
    {
        return WhitelistEntry::class;
    }
}
