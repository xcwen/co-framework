<?php

return array(

    //key 必须是要唯一的 否则会自动合并
    'admin'=>[
        'pattern' => '/admin',
        'controller' => 'Admin:Home:Default:index',
    ],

    'node_add'=>[
        'pattern' => '/node/add',
        'controller' => 'Admin:Index:Index:addNode',
    ],

    'node_remove'=>[
        'pattern' => '/node/remove',
        'controller' => 'Admin:Index:Index:removeNode',
    ],

    'node_close'=>[
        'pattern' => '/node/close',
        'controller' => 'Admin:Index:Index:closeNode',
    ],

    'node_delete'=>[
        'pattern' => '/node/delete',
        'controller' => 'Admin:Index:Index:deleteNode',
    ],

    'node_reload'=>[
        'pattern' => '/node/reload',
        'controller' => 'Admin:Index:Index:reloadNode',
    ],

    'node_online'=>[
        'pattern' => '/node/online',
        'controller' => 'Admin:Index:Index:onlineNode',
    ],

    'node_offline'=>[
        'pattern' => '/node/offline',
        'controller' => 'Admin:Index:Index:offlineNode',
    ],
);
