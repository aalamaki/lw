<?php
// $Id: flexifilter.flexifilters.inc,v 1.4.6.3 2008/06/18 21:30:09 cwgordon7 Exp $

/**
 * Implementation of hook_flexifilters.
 */
function flexifilter_flexifilters() {
  return array(
    array(
      'label' => 'Mediawiki Format',
      'description' => 'This is an example format which provides a wikimedia-style input format.',
      'pid' => 'new',
      'enabled' => true,
      'advanced' => true,
      'delta' => '0',
      'components' => array(
        array(
          'type' => FLEXIFILTER_COMPONENT,
          'class' => 'flexifilter_text_prepend',
          'settings' => array(
            'text' => '</nowiki>',
            'step' => 'process',
          ),
          'pid' => 'new',
        ),
        array(
          'type' => FLEXIFILTER_COMPONENT,
          'class' => 'flexifilter_text_append',
          'settings' => array(
            'text' => '<nowiki>',
            'step' => 'process',
          ),
          'pid' => 'new',
        ),
        array(
          'type' => FLEXIFILTER_COMPONENT,
          'class' => 'flexifilter_chunk_grab',
          'settings' => array(
            'starts' => '</nowiki>',
            'ends' => '<nowiki>',
            'pass_limits' => 0,
            'case_sensitive' => 0,
            'include_rest' => 1,
            'step' => 'process',
            'components' => array(
              array(
                'type' => FLEXIFILTER_COMPONENT,
                'class' => 'flexifilter_text_alternation',
                'settings' => array(
                  'find' => '====',
                  'replace' => "<h4>\n</h4>",
                  'step' => 'process',
                ),
                'pid' => 'new',
              ),
              array(
                'type' => FLEXIFILTER_COMPONENT,
                'class' => 'flexifilter_text_alternation',
                'settings' => array(
                  'find' => '===',
                  'replace' => "<h3>\n</h3>",
                  'step' => 'process',
                ),
                'pid' => 'new',
              ),
              array(
                'type' => FLEXIFILTER_COMPONENT,
                'class' => 'flexifilter_text_alternation',
                'settings' => array(
                  'find' => '==',
                  'replace' => "<h2>\n</h2>",
                  'step' => 'process',
                ),
                'pid' => 'new',
              ),
              array(
                'type' => FLEXIFILTER_COMPONENT,
                'class' => 'flexifilter_text_alternation',
                'settings' => array(
                  'find' => '\'\'\'',
                  'replace' => "<strong>\n</strong>",
                  'step' => 'process',
                ),
                'pid' => 'new',
              ),
              array(
                'type' => FLEXIFILTER_COMPONENT,
                'class' => 'flexifilter_text_alternation',
                'settings' => array(
                  'find' => '\'\'',
                  'replace' => "<em>\n</em>",
                  'step' => 'process',
                ),
                'pid' => 'new',
              ),
              array(
                'type' => FLEXIFILTER_COMPONENT,
                'class' => 'flexifilter_chunk_grab',
                'settings' => array(
                  'starts' => '[[',
                  'ends' => ']]',
                  'pass_limits' => 0,
                  'case_sensitive' => 0,
                  'include_rest' => 1,
                  'step' => 'process',
                  'components' => array(
                    array(
                      'type' => FLEXIFILTER_COMPONENT,
                      'class' => 'flexifilter_control_if',
                      'settings' => array(
                        'components' => array(
                          array(
                            'type' => FLEXIFILTER_COMPONENT,
                            'class' => 'flexifilter_text_replace',
                            'settings' => array(
                              'find' => '~',
                              'replace' => '\\~',
                              'step' => 'process',
                            ),
                            'pid' => 'new',
                          ),
                          array(
                            'type' => FLEXIFILTER_COMPONENT,
                            'class' => 'flexifilter_text_append',
                            'settings' => array(
                              'text' => '~~',
                              'step' => 'process',
                            ),
                            'pid' => 'new',
                          ),
                          array(
                            'type' => FLEXIFILTER_COMPONENT,
                            'class' => 'flexifilter_advanced_append',
                            'settings' => array(
                              'step' => 'process',
                              'components' => array(
                                array(
                                  'type' => FLEXIFILTER_COMPONENT,
                                  'class' => 'flexifilter_text_replace',
                                  'settings' => array(
                                    'find' => '~~',
                                    'replace' => '</a>',
                                    'step' => 'process',
                                  ),
                                  'pid' => 'new',
                                ),
                              ),
                            ),
                            'pid' => 'new',
                          ),
                          array(
                            'type' => FLEXIFILTER_COMPONENT,
                            'class' => 'flexifilter_text_replace',
                            'settings' => array(
                              'find' => '~~',
                              'replace' => '">',
                              'step' => 'process',
                            ),
                            'pid' => 'new',
                          ),
                          array(
                            'type' => FLEXIFILTER_COMPONENT,
                            'class' => 'flexifilter_text_prepend',
                            'settings' => array(
                              'text' => '<a href="http://en.wikipedia.org/wiki/',
                              'step' => 'process',
                            ),
                            'pid' => 'new',
                          ),
                          array(
                            'type' => FLEXIFILTER_COMPONENT,
                            'class' => 'flexifilter_text_replace',
                            'settings' => array(
                              'find' => '\\~',
                              'replace' => '~',
                              'step' => 'process',
                            ),
                            'pid' => 'new',
                          ),
                        ),
                        'condition' => array(
                          'type' => FLEXIFILTER_CONDITION,
                          'class' => 'flexifilter_group_not',
                          'settings' => array(
                            'conditions' => array(
                              array(
                                'type' => FLEXIFILTER_CONDITION,
                                'class' => 'flexifilter_text_search',
                                'settings' => array(
                                  'find' => '|',
                                  'is_regex' => 0,
                                ),
                                'pid' => 'new',
                              ),
                            ),
                          ),
                          'pid' => 'new',
                        ),
                      ),
                      'pid' => 'new',
                    ),
                    array(
                      'type' => FLEXIFILTER_COMPONENT,
                      'class' => 'flexifilter_control_if',
                      'settings' =>  array(
                        'components' => array(
                          array(
                            'type' => FLEXIFILTER_COMPONENT,
                            'class' => 'flexifilter_text_prepend',
                            'settings' => array(
                              'text' => '<a href="http://en.wikipedia.org/wiki/',
                              'step' => 'process',
                            ),
                            'pid' => 'new',
                          ),
                          array(
                            'type' => FLEXIFILTER_COMPONENT,
                            'class' => 'flexifilter_text_replace',
                            'settings' => array(
                              'find' => '|',
                              'replace' => '">',
                              'step' => 'process',
                            ),
                            'pid' => 'new',
                          ),
                          array(
                            'type' => FLEXIFILTER_COMPONENT,
                            'class' => 'flexifilter_text_append',
                            'settings' => array(
                              'text' => '</a>',
                              'step' => 'process',
                            ),
                            'pid' => 'new',
                          ),
                        ),
                        'condition' => array(
                          'type' => FLEXIFILTER_CONDITION,
                          'class' => 'flexifilter_text_search',
                          'settings' => array(
                            'find' => '|',
                            'is_regex' => 0,
                          ),
                          'pid' => 'new',
                        ),
                      ),
                      'pid' => 'new',
                    ),
                  ),
                ),
                'pid' => 'new',
              ),
            ),
          ),
          'pid' => 'new',
        ),
      ),
      'fid' => 'new',
    ),
  );
}