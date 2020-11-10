<?php

/* @var $this \yii\web\View */
/* @var $content string */

use frontend\widgets\Blog\CategoriesWidget;
use frontend\widgets\Blog\LastCommentWidget;
use frontend\widgets\Blog\LastPostsWidget;
?>
<?php $this->beginContent('@frontend/views/layouts/main.php') ?>


    <div class="blog_page_section mt-70">
        <div class="container">
            <div class="row">

                <div class="col-lg-9 col-md-12">
                    <?= $content ?>


                </div>
                <div class="col-lg-3 col-md-12">
                    <div class="blog_sidebar_widget">
                        <div class="widget_list comments">
                            <div class="widget_title">
                                <h3>Последние коментарии</h3>
                            </div>

                            <?= LastCommentWidget::widget(['limit' => 4]) ?>
                        </div>
                        <div class="widget_list widget_post">
                            <div class="widget_title">
                                <h3>Недавние посты</h3>
                            </div>

                            <?= LastPostsWidget::widget(['limit' => 4, 'view' => 'last-post-blog'])?>

                        </div>
                        <div class="widget_list widget_categories">

                            <div class="widget_title">
                                <h3>Категории</h3>
                            </div>
                            <?= CategoriesWidget::widget([
                                'active' => $this->params['active_category'] ?? null
                            ]) ?>

                        </div>
                        <div class="widget_list widget_tag">
                            <div class="widget_title">
                                <h3>Тэги блога</h3>
                            </div>
                            <div class="tag_widget">
                                <?= \frontend\widgets\Blog\TagBlogWidget::widget() ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $this->endContent() ?>