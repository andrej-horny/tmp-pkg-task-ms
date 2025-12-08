<?php

return [
    'list_heading' => 'Nadchádzajúce kontroly',
    'form' => [
        'fields' => [
            'code' => [
                'label' => 'Kód',
                'helper' => 'Jedinečný identifikátor záznamu použitý v aplikácií',
                'tooltip' => 'Jedinečný identifikátor záznamu použitý v aplikácií',
            ],
            'date' => 'Dátum',
            'title' => 'Názov',
            'description' => 'Popis',
            'source' => 'Miesto výskytu',
        ],
        'tabs' => [
            'activities' => 'Činnosti / normy',
            'materials' => 'Materiál',
            'services' => 'Služby',
        ]
    ],
    'table' => [
        'heading' => 'Nadchádzajúce kontroly',
        'empty_state_heading' => 'Žiadne nadchádzajúce kontroly na zobrazenie',
        'row_groups' => [
        ],
        'columns' => [
            'id' => ['label' => 'ID'],
            'date' => ['label' => 'Dátum'],
            'template' => ['label' => 'Typ kontroly'],
            'state' => ['label' => 'Stav'],
            'subject' => ['label' => 'Vozidlo'],
            'note' => ['label' => 'Poznámka'],
            'maintenance_group' => ['label' => 'Prevádzka'],
            'distance_traveled' => ['label' => 'Stav km'],
            'due_distance' => ['label' => 'Kontrola pri stave km'],
            'km_to_due_distance' => ['label' => 'Km do kontroly'],
            'due_date' => ['label' => 'Dátum kontroly'],
            'days_to_due_date' => ['label' => 'Dní do kontroly'],
        ],
        'actions' => [
            'create_ticket' => 'Vyvoriť zákazku',
        ]
    ],
    'navigation' => [
        'label' => 'Nadchádzajúce kontroly',
        'group' => 'Kontroly',
    ],
    'resource' => [
        'model_label' => 'Nadchádzajúca kontrola',
        'plural_model_label' => 'Nadchádzajúce kontroly',
    ],
    'states' => [
        'upcoming' => 'Nadchádzajúca',
    ]
];