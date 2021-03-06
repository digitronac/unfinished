<?php

use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'dependencies' => [
        'invokables' => [
            Zend\Expressive\Helper\ServerUrlHelper::class => Zend\Expressive\Helper\ServerUrlHelper::class,
            Zend\Expressive\Router\RouterInterface::class => Zend\Expressive\Router\ZendRouter::class,
        ],
        'factories'  => [
            // Default factories
            Zend\Db\Adapter\Adapter::class                            => Zend\Db\Adapter\AdapterServiceFactory::class,
            'session'                                                 => Core\Factory\SessionFactory::class,
            Zend\Expressive\Application::class                        => Zend\Expressive\Container\ApplicationFactory::class,
            Zend\Expressive\Helper\UrlHelper::class                   => Zend\Expressive\Helper\UrlHelperFactory::class,
            Zend\Expressive\Template\TemplateRendererInterface::class => Zend\Expressive\ZendView\ZendViewRendererFactory::class,
            Zend\View\HelperPluginManager::class                      => Zend\Expressive\ZendView\HelperPluginManagerFactory::class,

            // Services
            Core\Service\AdminUserService::class                      => Core\Factory\Service\AdminUserServiceFactory::class,
            Core\Service\TagService::class                            => Core\Factory\Service\TagServiceFactory::class,
            Core\Service\PostService::class                           => Core\Factory\Service\PostServiceFactory::class,
            Core\Service\DiscussionService::class                     => Core\Factory\Service\DiscussionServiceFactory::class,
            Core\Service\EventService::class                          => Core\Factory\Service\EventServiceFactory::class,
            Core\Service\VideoService::class                          => Core\Factory\Service\VideoServiceFactory::class,

            // Mappers
            Core\Mapper\AdminUsersMapper::class                       => Core\Factory\MapperFactory::class,
            Core\Mapper\ArticleMapper::class                          => Core\Factory\MapperFactory::class,
            Core\Mapper\TagsMapper::class                             => Core\Factory\MapperFactory::class,
            Core\Mapper\ArticlePostsMapper::class                     => Core\Factory\MapperFactory::class,
            Core\Mapper\ArticleDiscussionsMapper::class               => Core\Factory\MapperFactory::class,
            Core\Mapper\ArticleTagsMapper::class                      => Core\Factory\MapperFactory::class,
            Core\Mapper\ArticleEventsMapper::class                    => Core\Factory\MapperFactory::class,
            Core\Mapper\ArticleVideosMapper::class                    => Core\Factory\MapperFactory::class,

            // Filters
            Core\Filter\TagFilter::class                              => InvokableFactory::class,
            Core\Filter\AdminUserFilter::class                        => Core\Factory\FilterFactory::class,
            Core\Filter\ArticleFilter::class                          => InvokableFactory::class,
            Core\Filter\PostFilter::class                             => InvokableFactory::class,
            Core\Filter\DiscussionFilter::class                       => InvokableFactory::class,
            Core\Filter\EventFilter::class                            => InvokableFactory::class,
            Core\Filter\VideoFilter::class                            => InvokableFactory::class,
        ],
    ],
];
