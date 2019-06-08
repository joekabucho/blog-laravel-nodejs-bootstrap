<?php
/*
 * This file is part of Xblog.
 * This file defines variables to config your blog.
 * Rendered in admin/settings.blade.php
 * Support type:
 *   1. text
 *   2. textarea
 *   3. radio
 *   4. number
 *   5. others
 */
return [
    'groups' => [
        [
            'group_name' => 'Commonly used',
            'children' => [
                [
                    'name' => 'google_analytics',
                    'type' => 'radio',
                    'default' => 'false',
                    'values' => [
                        'true' => 'Enable Google Analytics',
                        'false' => 'Disable Google Analytics',
                    ],
                ],
                [
                    'name' => 'enable_mail_notification',
                    'type' => 'radio',
                    'default' => 'false',
                    'values' => [
                        'true' => 'Enable email notifications',
                        'false' => 'Disable email notifications',
                    ],
                ],
                [
                    'name' => 'comment_type',
                    'type' => 'radio',
                    'default' => 'raw',
                    'values' => [
                        'none' => 'Close comment (not shown)',
                        'raw' => 'Bring your own comments',
                        'disqus' => 'Disqus',
                    ],
                ],
                [
                    'name' => 'allow_comment',
                    'type' => 'radio',
                    'default' => 'true',
                    'values' => [
                        'true' => 'Allow comments',
                        'false' => 'Prohibit comments (still showing comments already)',
                    ],
                ],
                [
                    'name' => 'enable_hot_posts',
                    'type' => 'radio',
                    'default' => 'false',
                    'values' => [
                        'true' => 'Enable popular articles',
                        'false' => 'Disable popular articles',
                    ],
                ],
                [
                    'name' => 'open_pay',
                    'type' => 'radio',
                    'default' => 'false',
                    'values' => [
                        'true' => 'Open appreciation',
                        'false' => 'Close appreciation',
                    ],
                ],
                [
                    'name' => 'pay_description',
                    'label' => 'Appreciate the description',
                    'default' => 'Written well, sponsor the hosting fee'
                ],
            ]
        ],

        [
            'group_name' => 'Personal information',
            'children' => [
                [
                    'name' => 'author',
                    'label' => 'Author',
                ],
                [
                    'name' => 'description',
                    'label' => 'Author',
                ],
                [
                    'name' => 'avatar',
                    'label' => 'Avatar',
                ],
                [
                    'name' => 'other_information',
                    'type' => 'textarea',
                    "placeholder" => "Support for text and html",
                    'label' => 'other information',
                ],
                [
                    'name' => 'social_facebook',
                    'label' => 'Facebook link',
                ],
                [
                    'name' => 'social_twitter',
                    'label' => 'Twitter link',
                ],
                [
                    'name' => 'social_github',
                    'label' => 'GitHub link',
                ],
                [
                    'name' => 'social_weibo',
                    'label' => 'Weibo link',
                ],
                [
                    'name' => 'social_instagram',
                    'label' => 'Instagram link',
                ],
                [
                    'name' => 'social_googleplus',
                    'label' => 'Google+ link',
                ],
                [
                    'name' => 'social_tumblr',
                    'label' => 'Tumblr link',
                ],
                [
                    'name' => 'social_stackoverflow',
                    'label' => 'StackOverflow link',
                ],
                [
                    'name' => 'social_dribbble',
                    'label' => 'Dribbble link',
                ],
                [
                    'name' => 'social_linkedin',
                    'label' => 'LinkedIn link',
                ],
                [
                    'name' => 'social_gitlab',
                    'label' => 'GitLab link',
                ],
                [
                    'name' => 'social_pinterest',
                    'label' => 'Pinterest link',
                ],
                [
                    'name' => 'social_youtube',
                    'label' => 'YouTube link',
                ],
            ]
        ],
        [
            'group_name' => 'website',
            'children' => [
                [
                    'name' => 'google_trace_id',
                    'label' => 'Tracking ID',
                    'placeholder' => 'Google Tracking ID'
                ],
                [
                    'name' => 'disqus_shortname',
                    'label' => 'Disqus ID',
                ],
                [
                    'name' => 'github_username',
                    'label' => 'Github username',
                ],
                [
                    'name' => 'blog_brand',
                    'label' => 'Logo',
                    "placeholder" => "Support for text and html",
                    "type" => "textarea"
                ],
                [
                    'name' => 'site_title',
                    'label' => 'title',
                ],
                [
                    'name' => 'site_keywords',
                    'label' => 'Keyword',
                    "placeholder" => "Website keyword"
                ],
                [
                    'name' => 'site_description',
                    'label' => 'Website description',
                ],
                [
                    'name' => 'site_header_title',
                    'label' => 'Website Head Title',
                ],
                [
                    'name' => 'page_size',
                    'label' => 'Number of pages per page',
                    'default' => 7,
                    "type" => "number"
                ],
                [
                    'name' => 'hot_posts_count',
                    'label' => 'Popular article count',
                    'default' => 5,
                    "type" => "number"
                ],
                [
                    'name' => 'case_number',
                    'label' => 'case number'
                ],
            ]
        ],
        [
            'group_name' => 'image',
            'children' => [

                [
                    'name' => 'profile_image',
                    'label' => 'Profile picture',
                ],
                [
                    'name' => 'header_bg_image',
                    'label' => 'Header background image',
                ],
                [
                    'name' => 'header_image_provider',
                    'type' => 'radio',
                    'default' => 'none',
                    'label' => 'Dynamic Header Background Picture',
                    'values' => [
                        'none' => 'shut down',
                        'bing' => 'Bing Daily Wallpaper',
                        'picsum' => 'Picsum',
                    ],
                ],
                [
                    'name' => 'header_image_update_rate',
                    'type' => 'radio',
                    'default' => 'every_day',
                    'label' => 'Dynamic Header background image update frequency',
                    'values' => [
                        'every_minute' => 'every minute',
                        'every_hour' => 'per hour',
                        'every_day' => 'every day',
                        'every_week' => 'weekly',
                    ],
                ],
                [
                    'name' => 'admin_sidebar_bg_image',
                    'label' => 'Dashboard background image',
                ],
                [
                    'name' => 'home_bg_images',
                    'label' => 'Home background image',
                    "type" => "textarea",
                    "placeholder" => "Can be multiple, one line per line"
                ],
                [
                    'name' => 'zhifubao_pay_image_url',
                    'label' => 'Alipay payment QR code',
                ],
                [
                    'name' => 'wechat_pay_image_url',
                    'label' => 'WeChat payment QR code',
                ],
            ]
        ],
    ],
];