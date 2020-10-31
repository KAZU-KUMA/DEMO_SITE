<?php $GLOBALS['ADDITIONAL_HEAD'] = function() {?>
    <!-- このページのみCSS -->
    <link rel="stylesheet" href="<?=get_template_directory_uri();?>/css/front_page.css">
    <link rel="stylesheet" href="<?=get_template_directory_uri();?>/css/news.css">
    <link rel="stylesheet" href="<?=get_template_directory_uri();?>/css/event.css">
<?php }?>
<?php get_header(); ?>
<main>        
    <!-- コンテンツ100% -->
    <div class="contents">
        <!-- コンテナ960px -->
        <div class="container">
            <?php if($top_news = get_field('top_news')):?>
                <div class="noticeBox">
                    <h2>重要なお知らせ</h2>
                    <div class="txtArea"><p><?=$top_news;?></p></div>
                </div>
            <?php endif; ?>

            <div class="noticeBox">
            <h2>ニュース</h2>
            <div class="top_news">
                <?php
                    $paged = get_query_var('paged') ?: 1;
                    $args  = array(
                        'post_type' => 'news',
                        'posts_per_page' => 3, 
                        'paged' => $paged,
                    );
                    $the_query = new WP_Query( $args );
                    if ( $the_query->have_posts() ) :
                        while ( $the_query->have_posts() ) : $the_query->the_post();
                        $article = SCF::get('news'); 
                        foreach ($article as $news): ?>
                        <dl>
                            <dt class="days"><?= esc_html($news['news_day']); ?></dt>
                            <dt class="news_title"><?= esc_html($news['news_title']); ?></dt>
                            <dd class="news_text"><?= esc_html($news['news_text']); ?></dd>
                        </dl>

                        <? endforeach; 
                        endwhile;
                    endif; ?>
              </div>
            </div>

            <div class="noticeBox">
            <h2>イベント情報</h2>
            <div class="top_event">
            <ul class="event_lists">
            <?php
                    $paged = get_query_var('paged') ?: 1;
                    $args  = array(
                      'post_type' => 'event',
                      'posts_per_page' => 3, 
                      'paged' => $paged,
                    );
                    $the_query = new WP_Query( $args );
                    if ( $the_query->have_posts() ) :
                        while ( $the_query->have_posts() ) : $the_query->the_post();?>
                            <li class="event_list">
                                <a href="<?=esc_url(get_the_permalink($post->ID));?>">
                                    <div class="list_content">
                                        <div class="photo_area">
                                            <img src="<?= getImage('event_image')?>" alt="">
                                        </div>
                                        <div class="top_area">
                                            <div class="label_area place"><?=esc_html(get_field('event_area'));?></div>
                                            <div class="event_date_archive"><?=esc_html(get_field('event_day'));?></div>
                                        </div>
                                        <div class="event_title"><?=esc_html(get_field('event_title'));?></div>                                       
                                        <div class="event_description"><?=esc_html(limit_length( get_field('event_text'),50));?></div>
                                    </div>
                                </a>
                            </li>
                        <? endwhile;
                    endif; ?>
            </ul>
            </div>
        </div>

            <div class="top_about">
                <h1 class="sub_title">新潟県について</h1>
                <p>新潟県は、日本海側北部に位置し、佐渡島・粟島も県域に含む。<br>
                    面積は全国5位。また、南北に非常に長い県であり、直線距離は北海道を除く全県で最も長い。その長さは岩手県を凌ぎ、海岸線は約300キロに及ぶ。</p>
                <table class="tableList">
                    <tr><th>面積</th><td>1万2584.1km2</td></tr>
                    <tr><th>人口</th><td>230万4264</td></tr>
                    <tr><th>年降水量</th><td>1821mm</td></tr>
                    <tr><th>年平均気温</th><td>13.9℃</td></tr>
                    <tr><th>県庁所在地</th><td>新潟市</td></tr>
                    <tr><th>県木</th><td>ユキツバキ</td></tr>
                    <tr><th>県花</th><td>チューリップ</td></tr>
                    <tr><th>県鳥</th><td>トキ</td></tr>
                </table>
            </div>


        </div> <!--containers-->
    </div> <!--contents-->
<main>
<?php get_footer(); ?>