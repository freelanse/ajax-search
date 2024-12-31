# ajax-search



Подсказка для таксаномии

    $taxonomy1_terms = get_terms(array(
        'taxonomy' => 'service-category',
        'name__like' => $search_query,
        'number' => 5,
    ));

    foreach ($taxonomy1_terms as $term) {
        $suggestions[] = array(
            'label' => $term->name,
            'link' => get_term_link($term),
            'type' => 'service-category'
        );
    }
