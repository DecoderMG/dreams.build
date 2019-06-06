<?php
/*Template Name: Dashboard*/
get_header(); ?>
<?php while (have_posts()) : the_post(); ?>
    <div
        class="top_banner<?= (isset($_GET['edit_project']) || isset($_GET['create_project'])) ? ' project_creation' : ''; ?>">
        <div class="shadow"></div>
        <div class="container">
            <?php if (isset($_GET['edit_project']) || isset($_GET['create_project'])){ ?>
                <div class="row project-topstats">
                    <div class="col-lg-6">
                        <?php global $postpro_id;
                        $postpro_id = $_GET['edit_project'];
                        $_post = get_post($postpro_id); //maybe make $post global???? ?>
                        <?php global $poststatus;
                        $poststatus = $_post->post_status; ?>
                        <span
                            class="info-edit">My Dream <?= isset($_GET['edit_project']) ? '<i class="fa fa-pencil"></i></span>' : ''; ?>
                            <h3><?= isset($_GET['edit_project']) ? get_the_title($postpro_id) : 'New Dream'; ?></h3>
                    </div>
                    <div class="col-lg-3">
                        <span class="info" title="Current Status of your project. It can be New, Draft, Pending Review, Published (Live), or Closed">Status <i class="fa fa-info-circle"></i></span>
                        <h3 class="grey"><?= isset($_GET['create_project']) ? 'New' : $_post->post_status; ?></h3>
                    </div>
                    <div class="col-lg-3">
                        <span class="info" title="Indicator of how strong your project's content is. The higher this value the more likely you are to be funded.">Build Completion <i
                                class="fa fa-info-circle"></i></span>
                        <?php /*$progress = 0;
						if(isset($_GET['edit_project'])){
							$meta = get_post_meta($postpro_id);
							$a = array('ign_fund_goal','ign_start_date','ign_company_logo','ign_fund_end','ign_project_description','ign_project_long_description','ign_product_title','ign_product_price','ign_product_image2','ign_product_image3','ign_product_image4','ign_faqs','ign_updates','ign_challenges','ign_follow_twitter','ign_follow_facebook','ign_follow_google','ign_follow_in','ign_follow_instagram','ign_follow_website','ign_collective_benefits','ign_individual_rewards','ign_business_plan','ign_company_name','ign_company_location','ign_company_url','ign_company_fb','ign_company_twitter','ign_map_lat','ign_map_lng','ign_product_video','ign_fund_end2','ign_ga','ign_fund_goal2');
							$i=0;foreach ($meta as $meta_key => $v) {
								foreach ($v as $kk => $meta_value) {
									if(in_array($meta_key, $a) && !empty($meta_value)) $i++;
									//echo "$meta_key => $meta_value.\n";
									break;
								}
							}
							// 2 - title & category
							$progress = round(($i+2)*100/(count($a)+2));
						}*/
                        ?>
                        <h3 class="green"></h3>
                        <div class="progress">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40"
                                 aria-valuemin="0" aria-valuemax="100"
                                 style="width:<?= /*isset($_GET['edit_project'])?'100%':*/
                                 '0%'; ?>"></div>
                        </div>
                    </div>

                </div>
            <?php } else if (isset($_GET['analytics'])) { ?>
                <div class="row">
                    <div class="col-lg-12" style="padding: 45px 0 0;">
                        <?php $umeta = get_user_meta($current_user->ID); $projectid = absint($_GET['analytics']); $project_title = get_the_title($projectid); ?>
                        <?php if (!empty($current_user) && $current_user->ID): ?>
						    <h1 style="padding: 0px;">Analytics Dashboard for <?php echo $project_title ?></h1>
                        <?php else: ?>
                            <h1><?= get_the_title() ?></h1>
                        <?php endif; ?>
                    </div>
                    <?php

                    if(isset($_GET['ipn_handler'])){
                        $stripe_account = md_sc_account($current_user->ID);
                        if($stripe_account->details_submitted == true){ ?>
                            <div class="col-lg-12 notifications" style="margin: 20px 0 0;">
                                <div class="ignitiondeck">
                                    <p class="notification green" style="text-align: center">
                                        Stripe account is connected and ready to go! If you saved a draft, you will see the project ready to be finished below.
                                    </p>
                                </div>
                            </div>
                    <?php }
                    }
                    if(isset($_GET['stripe_disconnect']) && $_GET['stripe_disconnect'] == 'yes'){ ?>
                        <div class="col-lg-12 notifications" style="margin: 20px 0 0;">
                            <div class="ignitiondeck">
                                <p class="notification green" style="text-align: center">
                                    Stripe account is disconnected
                                </p>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php } else { ?>
                <div class="row">
                    <div class="col-lg-12" style="padding: 45px 0 0;">
                        <?php $umeta = get_user_meta($current_user->ID); ?>
                        <?php if (!empty($current_user) && $current_user->ID): ?>
						<?php echo do_shortcode('[mycred_my_rank user_id="current" show_title=1 show_logo=1]'); ?><p style="display: inline-block;">&nbsp;with&nbsp;<strong><?php echo do_shortcode('[mycred_total_balance total=0 raw=0]'); ?></strong>&nbsp;dbPoints&nbsp;</p><sup><i class="fa fa-info-circle"></i></sup>
                            <h1 style="padding: 0px;"><?= empty($current_user) ? get_the_title() : $umeta['first_name'][0] . ' ' . $umeta['last_name'][0]; ?>
                                <a class="view_public" href="<?= get_author_posts_url($current_user->ID) ?>"><i
                                        class="fa fa-eye"></i> View Public Profile</a>
                            </h1>
                        <?php else: ?>
                            <h1><?= get_the_title() ?></h1>
                        <?php endif; ?>
                    </div>
                    <?php

                    if(isset($_GET['ipn_handler'])){
                        $stripe_account = md_sc_account($current_user->ID);
                        if($stripe_account->details_submitted == true){ ?>
                            <div class="col-lg-12 notifications" style="margin: 20px 0 0;">
                                <div class="ignitiondeck">
                                    <p class="notification green" style="text-align: center">
                                        Stripe account is connected and ready to go! If you saved a draft, you will see the project ready to be finished below.
                                    </p>
                                </div>
                            </div>
                    <?php }
                    }
                    if(isset($_GET['stripe_disconnect']) && $_GET['stripe_disconnect'] == 'yes'){ ?>
                        <div class="col-lg-12 notifications" style="margin: 20px 0 0;">
                            <div class="ignitiondeck">
                                <p class="notification green" style="text-align: center">
                                    Stripe account is disconnected
                                </p>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    </div>
    <div
        class="wide_content gray<?= (isset($_GET['edit_project']) || isset($_GET['create_project'])) ? ' project_creation' : ''; ?>">
        <div class="shadow"></div>
        <div class="container">
            <?php the_content(); ?>
        </div>
    </div>
<?php endwhile; ?>

<?php get_footer(); ?>
