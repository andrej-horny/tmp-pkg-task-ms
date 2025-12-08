<?php

return [
    'create_heading' => 'Vytvoriť typ udalosti',
    'list_heading' => 'Typy udalostí',
    'update_heading' => 'Upraviť typ udalosti: :title',
    'form' => [
        'fields' => [
            'code' => [
                'label' => 'Kód',
                'hint' => 'Jedinečný identifikátor záznamu použitý v aplikácií',
                'tooltip' => 'Jedinečný identifikátor záznamu použitý v aplikácií',
            ],
            'title' => 'Názov',
        ],
    ],
    'table' => [
        'heading' => 'Typy udalostí',
        'empty_state_heading' => 'Žiadne typy udalostí na zobrazenie',
        'columns' => [
            'id' => 'ID',
            'code' => 'Kód',
            'title' => 'Názov',
        ],
    ],
    'navigation' => [
        'label' => 'Typy udalostí',
        'group' => 'Udalosti',
    ],
    'resource' => [
        'model_label' => 'Typ udalosti',
        'plural_model_label' => 'Typy udalostí',
    ],
];