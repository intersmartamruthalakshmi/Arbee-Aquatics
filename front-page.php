<?php
/**
 * Home page — converted from index1.php.
 *
 * @package Arbee
 */

defined( 'ABSPATH' ) || exit;

get_header();

$arbee_slides   = arbee_rows( 'banner_slides' );
$arbee_products = arbee_rows( 'banner_products' );
?>
<div id="pageWrapper" class="homePage">

	<?php if ( $arbee_slides ) : ?>
		<section id="MainBanner">
			<div class="swiper bannerSlider">
				<div class="swiper-wrapper">
					<?php foreach ( $arbee_slides as $arbee_slide ) : ?>
						<?php
						$arbee_video  = arbee_file_url( arbee_v( $arbee_slide, 'video' ) );
						$arbee_poster = arbee_v( $arbee_slide, 'poster' ) ? wp_get_attachment_image_url( (int) arbee_v( $arbee_slide, 'poster' ), 'full' ) : '';
						$arbee_btns   = is_array( arbee_v( $arbee_slide, 'buttons' ) ) ? arbee_v( $arbee_slide, 'buttons' ) : array();
						?>
						<div class="swiper-slide">
							<div class="bannerSlide">
								<div class="bgImgWrap">
									<?php if ( $arbee_video ) : ?>
										<video width="1920" height="940" autoplay muted loop playsinline<?php echo $arbee_poster ? ' poster="' . esc_url( $arbee_poster ) . '"' : ''; ?>>
											<source src="<?php echo esc_url( $arbee_video ); ?>" type="video/mp4">
											Your browser does not support the video tag.
										</video>
									<?php elseif ( arbee_v( $arbee_slide, 'poster' ) ) : ?>
										<?php echo arbee_image( arbee_v( $arbee_slide, 'poster' ), array( 'width' => 1920, 'height' => 940, 'alt' => '' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
									<?php endif; ?>
								</div>
								<div class="container">
									<div class="bannerWrapper">
										<div class="dFlx">
											<div class="lSide">
												<div class="bannerBx">
													<?php if ( arbee_has( arbee_v( $arbee_slide, 'title' ) ) ) : ?>
														<div class="title"><?php echo arbee_lines( arbee_v( $arbee_slide, 'title' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
													<?php endif; ?>
													<?php if ( arbee_has( arbee_v( $arbee_slide, 'text' ) ) ) : ?>
														<div class="txt"><?php echo arbee_lines( arbee_v( $arbee_slide, 'text' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
													<?php endif; ?>
													<?php
													$arbee_btn_html = '';
													foreach ( $arbee_btns as $arbee_btn ) {
														$arbee_a = arbee_link( arbee_v( $arbee_btn, 'link' ), 'expmorebth' );
														if ( $arbee_a ) {
															$arbee_btn_html .= '<div class="item">' . $arbee_a . '</div>';
														}
													}
													if ( $arbee_btn_html ) {
														echo '<div class="btnWrap">' . $arbee_btn_html . '</div>'; // phpcs:ignore WordPress.Security.EscapeOutput
													}
													?>
												</div>
											</div>
											<?php if ( $arbee_products ) : ?>
												<div class="rgSide">
													<div class="productWrapper">
														<?php foreach ( $arbee_products as $arbee_i => $arbee_p ) : ?>
															<div class="item">
																<a class="prodBx"<?php echo arbee_link_attrs( arbee_v( $arbee_p, 'link' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?>>
																	<?php if ( arbee_v( $arbee_p, 'image' ) ) : ?>
																		<div class="bxImg">
																			<?php echo arbee_image( arbee_v( $arbee_p, 'image' ), array( 'width' => 85, 'height' => 80, 'alt' => arbee_v( $arbee_p, 'title' ) ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
																		</div>
																	<?php endif; ?>
																	<div class="bxCnt">
																		<div class="index"><?php echo esc_html( arbee_index( $arbee_i ) ); ?></div>
																		<div class="title"><?php echo arbee_text( arbee_v( $arbee_p, 'title' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
																		<?php if ( arbee_has( arbee_v( $arbee_p, 'link_text' ) ) ) : ?>
																			<div class="txt"><?php echo arbee_text( arbee_v( $arbee_p, 'link_text' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
																		<?php endif; ?>
																	</div>
																</a>
															</div>
														<?php endforeach; ?>
													</div>
												</div>
											<?php endif; ?>
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<?php arbee_part( 'sections/trusted' ); ?>

	<?php
	$arbee_snippets      = arbee_rows( 'snippet_items' );
	$arbee_snippet_title = arbee_get( 'snippet_title' );
	if ( empty( $arbee_snippet_title ) || 'Product Snippet' === $arbee_snippet_title ) {
		$arbee_snippet_title = 'Product Snippet 2';
	}
	?>
	<?php if ( $arbee_snippets || arbee_has( $arbee_snippet_title ) ) : ?>
		<section id="Snippet">
			<div class="container">
				<div class="tleWrap">
					<?php if ( arbee_has( $arbee_snippet_title ) ) : ?>
						<div class="title"><?php echo arbee_text( $arbee_snippet_title ); // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
					<?php endif; ?>
					<?php if ( arbee_has( arbee_get( 'snippet_text' ) ) ) : ?>
						<div class="txt"><?php echo arbee_lines( arbee_get( 'snippet_text' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
					<?php endif; ?>
				</div>
				<?php if ( $arbee_snippets ) : ?>
					<div class="swiper snippetSlider">
						<div class="swiper-wrapper">
							<?php foreach ( $arbee_snippets as $arbee_s ) : ?>
								<div class="swiper-slide">
									<div class="snipbx">
										<div class="bxImg">
											<?php echo arbee_image( arbee_v( $arbee_s, 'image' ), array( 'width' => 850, 'height' => 550, 'loading' => 'lazy', 'class' => 'lazy', 'alt' => arbee_v( $arbee_s, 'title' ) ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
										</div>
										<div class="bxCnt">
											<div class="title"><?php echo arbee_text( arbee_v( $arbee_s, 'title' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
											<div class="hideBx">
												<div class="title"><?php echo arbee_text( arbee_v( $arbee_s, 'hover_title' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
												<?php if ( arbee_has( arbee_v( $arbee_s, 'text' ) ) ) : ?>
													<div class="txt"><?php echo arbee_lines( arbee_v( $arbee_s, 'text' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
												<?php endif; ?>
												<?php echo arbee_link( arbee_v( $arbee_s, 'link' ), 'expmorebth' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
											</div>
										</div>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
						<div class="swiper-pagination"></div>
					</div>
				<?php endif; ?>
			</div>
		</section>
	<?php endif; ?>

	<?php $arbee_why = arbee_rows( 'why_items' ); ?>
	<?php if ( $arbee_why || arbee_has( arbee_get( 'why_title' ) ) ) : ?>
		<section id="WhyArbee">
			<div class="container">
				<div class="dFlx">
					<div class="lSide">
						<?php if ( $arbee_why ) : ?>
							<div class="arbeeWrapper">
								<?php foreach ( $arbee_why as $arbee_w ) : ?>
									<div class="item">
										<div class="arbeeBx">
											<?php if ( arbee_v( $arbee_w, 'icon' ) ) : ?>
												<div class="icon">
													<?php echo arbee_image( arbee_v( $arbee_w, 'icon' ), array( 'width' => 40, 'height' => 40, 'alt' => '' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
												</div>
											<?php endif; ?>
											<div class="bxCnt">
												<div class="title"><?php echo arbee_lines( arbee_v( $arbee_w, 'title' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
												<?php if ( arbee_has( arbee_v( $arbee_w, 'text' ) ) ) : ?>
													<div class="txt"><?php echo arbee_lines( arbee_v( $arbee_w, 'text' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
												<?php endif; ?>
											</div>
										</div>
									</div>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>
					</div>
					<div class="rgSide">
						<div class="tleWrap">
							<?php if ( arbee_has( arbee_get( 'why_title' ) ) ) : ?>
								<div class="title"><?php echo arbee_text( arbee_get( 'why_title' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
							<?php endif; ?>
							<?php if ( arbee_has( arbee_get( 'why_text' ) ) ) : ?>
								<div class="txt"><?php echo arbee_lines( arbee_get( 'why_text' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
							<?php endif; ?>
						</div>
						<?php echo arbee_link( arbee_get( 'why_button' ), 'expmorebth' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
					</div>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<?php
	$arbee_members = arbee_rows( 'members_items' );
	$arbee_mvideo  = arbee_file_url( arbee_get( 'members_video' ) );
	?>
	<?php if ( $arbee_members || arbee_has( arbee_get( 'members_title' ) ) ) : ?>
		<section id="MemberShip">
			<div class="container">
				<div class="dFlx">
					<div class="lSide">
						<div class="tleWrap">
							<?php if ( arbee_has( arbee_get( 'members_title' ) ) ) : ?>
								<div class="title"><?php echo arbee_text( arbee_get( 'members_title' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
							<?php endif; ?>
							<?php if ( arbee_has( arbee_get( 'members_text' ) ) ) : ?>
								<div class="txt"><?php echo arbee_lines( arbee_get( 'members_text' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
							<?php endif; ?>
						</div>
						<?php if ( $arbee_mvideo ) : ?>
							<div class="videoBx">
								<video autoplay muted loop playsinline>
									<source src="<?php echo esc_url( $arbee_mvideo ); ?>" type="video/mp4">
									Your browser does not support HTML5 video.
								</video>
							</div>
						<?php endif; ?>
					</div>
					<?php if ( $arbee_members ) : ?>
						<div class="rgSide">
							<div class="membershipWrapper">
								<?php foreach ( array_chunk( $arbee_members, (int) ceil( count( $arbee_members ) / 2 ) ) as $arbee_col ) : ?>
									<div class="gridCol">
										<?php foreach ( $arbee_col as $arbee_m ) : ?>
											<div class="item">
												<div class="memberBx">
													<?php if ( arbee_v( $arbee_m, 'icon' ) ) : ?>
														<div class="icon">
															<?php echo arbee_image( arbee_v( $arbee_m, 'icon' ), array( 'width' => 115, 'height' => 115, 'loading' => 'lazy', 'class' => 'lazy', 'alt' => arbee_v( $arbee_m, 'title' ) ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
														</div>
													<?php endif; ?>
													<div class="bxCnt">
														<div class="title"><?php echo arbee_lines( arbee_v( $arbee_m, 'title' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
														<?php if ( arbee_has( arbee_v( $arbee_m, 'text' ) ) ) : ?>
															<div class="txt"><?php echo arbee_lines( arbee_v( $arbee_m, 'text' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
														<?php endif; ?>
													</div>
												</div>
											</div>
										<?php endforeach; ?>
									</div>
								<?php endforeach; ?>
							</div>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<?php $arbee_groups = arbee_rows( 'globe_groups' ); ?>
	<?php if ( $arbee_groups || arbee_has( arbee_get( 'globe_title' ) ) ) : ?>
		<section id="Globe" class="globerf_section">
			<div class="container">
				<div class="dFlx">
					<div class="lSide">
						<div class="cntBx">
							<div class="tleWrap">
								<?php if ( arbee_has( arbee_get( 'globe_title' ) ) ) : ?>
									<div class="title"><?php echo arbee_text( arbee_get( 'globe_title' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
								<?php endif; ?>
								<?php if ( arbee_has( arbee_get( 'globe_text' ) ) ) : ?>
									<div class="txt"><?php echo arbee_lines( arbee_get( 'globe_text' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
								<?php endif; ?>
								<?php echo arbee_link( arbee_get( 'globe_button' ), 'expmorebth' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
							</div>
							<div class="overlayImg">
								<img src="<?php echo esc_url( arbee_asset( 'images/globe.svg' ) ); ?>" width="150" height="150" loading="lazy" class="lazy" alt="">
							</div>
						</div>
					</div>
					<div class="center">
						<?php if ( arbee_get( 'globe_image' ) ) : ?>
							<div class="bxMap">
								<?php echo arbee_image( arbee_get( 'globe_image' ), array( 'width' => 580, 'height' => 580, 'loading' => 'lazy', 'class' => 'lazy', 'alt' => 'globe' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
							</div>
						<?php endif; ?>
					</div>
					<div class="rgSide">
						<?php if ( $arbee_groups ) : ?>
							<div class="accordion accordglobe" id="accordionExample1">
								<?php
								foreach ( $arbee_groups as $arbee_i => $arbee_g ) :
									$arbee_open = (bool) arbee_v( $arbee_g, 'open' );
									$arbee_id   = 'globe-' . ( $arbee_i + 1 );
									$arbee_list = is_array( arbee_v( $arbee_g, 'countries' ) ) ? arbee_v( $arbee_g, 'countries' ) : array();
									?>
									<div class="accordion-item">
										<h2 class="accordion-header" id="heading-<?php echo esc_attr( $arbee_id ); ?>">
											<button class="accordion-button<?php echo $arbee_open ? '' : ' collapsed'; ?>" type="button" data-bs-toggle="collapse"
												data-bs-target="#collapse-<?php echo esc_attr( $arbee_id ); ?>" aria-expanded="<?php echo $arbee_open ? 'true' : 'false'; ?>" aria-controls="collapse-<?php echo esc_attr( $arbee_id ); ?>">
												<div class="globalAccoHead">
													<?php if ( arbee_v( $arbee_g, 'icon' ) ) : ?>
														<div class="icon">
															<?php echo arbee_image( arbee_v( $arbee_g, 'icon' ), array( 'width' => 50, 'height' => 50, 'loading' => 'lazy', 'class' => 'lazy', 'alt' => 'photo' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
														</div>
													<?php endif; ?>
													<div class="bxCnt">
														<div class="title"><?php echo arbee_text( arbee_v( $arbee_g, 'title' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
														<?php if ( arbee_has( arbee_v( $arbee_g, 'subtitle' ) ) ) : ?>
															<div class="txt"><?php echo arbee_text( arbee_v( $arbee_g, 'subtitle' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
														<?php endif; ?>
													</div>
												</div>
											</button>
										</h2>
										<div id="collapse-<?php echo esc_attr( $arbee_id ); ?>" class="accordion-collapse collapse<?php echo $arbee_open ? ' show' : ''; ?>" aria-labelledby="heading-<?php echo esc_attr( $arbee_id ); ?>"
											data-bs-parent="#accordionExample1">
											<div class="accordion-body">
												<?php if ( $arbee_list ) : ?>
													<ul class="kodgaprop">
														<?php foreach ( $arbee_list as $arbee_c ) : ?>
															<li><a><?php echo arbee_text( arbee_v( $arbee_c, 'name' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?> <?php if ( arbee_v( $arbee_c, 'flag' ) ) : ?><span><?php echo arbee_image( arbee_v( $arbee_c, 'flag' ), array( 'alt' => '' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span><?php endif; ?></a>
															</li>
														<?php endforeach; ?>
													</ul>
												<?php endif; ?>
											</div>
										</div>
									</div>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<?php $arbee_steps = arbee_rows( 'mfg_steps' ); ?>
	<?php if ( $arbee_steps || arbee_has( arbee_get( 'mfg_title' ) ) ) : ?>
		<section id="Manufacturing">
			<div class="overlayImg">
				<img src="<?php echo esc_url( arbee_asset( 'images/objectgt.svg' ) ); ?>" width="900" height="700" loading="lazy" class="lazy" alt="">
			</div>
			<div class="container">
				<div class="tleWrap">
					<?php if ( arbee_has( arbee_get( 'mfg_title' ) ) ) : ?>
						<div class="title"><?php echo arbee_lines( arbee_get( 'mfg_title' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
					<?php endif; ?>
					<?php if ( arbee_has( arbee_get( 'mfg_text' ) ) ) : ?>
						<div class="txt"><?php echo arbee_lines( arbee_get( 'mfg_text' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
					<?php endif; ?>
				</div>
				<?php if ( $arbee_steps ) : ?>
					<div class="swiper manufactureSlider">
						<div class="swiper-wrapper">
							<?php foreach ( $arbee_steps as $arbee_i => $arbee_st ) : ?>
								<div class="swiper-slide">
									<div class="manufactureBx">
										<?php if ( arbee_v( $arbee_st, 'icon' ) ) : ?>
											<div class="icon">
												<?php echo arbee_image( arbee_v( $arbee_st, 'icon' ), array( 'width' => 70, 'height' => 70, 'loading' => 'lazy', 'class' => 'lazy', 'alt' => '' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
											</div>
										<?php endif; ?>
										<div class="index"><?php echo esc_html( arbee_index( $arbee_i ) ); ?></div>
										<div class="bxCnt">
											<div class="title"><?php echo arbee_lines( arbee_v( $arbee_st, 'title' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
											<?php if ( arbee_has( arbee_v( $arbee_st, 'text' ) ) ) : ?>
												<div class="txt"><?php echo arbee_lines( arbee_v( $arbee_st, 'text' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
											<?php endif; ?>
										</div>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</section>
	<?php endif; ?>

	<?php $arbee_ocean = arbee_rows( 'ocean_items' ); ?>
	<?php if ( $arbee_ocean || arbee_has( arbee_get( 'ocean_title' ) ) ) : ?>
		<section id="PlanetOcean">
			<?php if ( arbee_get( 'ocean_image' ) ) : ?>
				<div class="overlayImg">
					<?php echo arbee_image( arbee_get( 'ocean_image' ), array( 'width' => 1920, 'height' => 700, 'loading' => 'lazy', 'class' => 'lazy', 'alt' => 'Ocean' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
				</div>
			<?php endif; ?>
			<div class="container">
				<div class="dFlx">
					<div class="lSide">
						<div class="tleWrap">
							<?php if ( arbee_has( arbee_get( 'ocean_title' ) ) ) : ?>
								<div class="title"><?php echo arbee_inline( arbee_get( 'ocean_title' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
							<?php endif; ?>
							<?php if ( arbee_has( arbee_get( 'ocean_text' ) ) ) : ?>
								<div class="txt"><?php echo arbee_lines( arbee_get( 'ocean_text' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
							<?php endif; ?>
							<?php echo arbee_link( arbee_get( 'ocean_button' ), 'expmorebth' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
						</div>
					</div>
					<?php if ( $arbee_ocean ) : ?>
						<div class="rgSide">
							<div class="oceanWrapper">
								<?php foreach ( $arbee_ocean as $arbee_o ) : ?>
									<div class="item">
										<div class="oceanBx">
											<?php if ( arbee_v( $arbee_o, 'icon' ) ) : ?>
												<div class="icon">
													<?php echo arbee_image( arbee_v( $arbee_o, 'icon' ), array( 'width' => 80, 'height' => 80, 'loading' => 'lazy', 'class' => 'lazy', 'alt' => '' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
												</div>
											<?php endif; ?>
											<div class="txt"><?php echo arbee_lines( arbee_v( $arbee_o, 'text' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
										</div>
									</div>
								<?php endforeach; ?>
							</div>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<?php if ( arbee_has( arbee_get( 'cta_title' ) ) || arbee_get( 'cta_image' ) ) : ?>
		<section id="GetInTouch">
			<div class="container">
				<div class="getInTouchBx">
					<div class="dFlx">
						<div class="lSide">
							<div class="tleWrap">
								<?php if ( arbee_has( arbee_get( 'cta_title' ) ) ) : ?>
									<div class="title"><?php echo arbee_lines( arbee_get( 'cta_title' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
								<?php endif; ?>
								<?php if ( arbee_has( arbee_get( 'cta_text' ) ) ) : ?>
									<div class="txt"><?php echo arbee_lines( arbee_get( 'cta_text' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
								<?php endif; ?>
								<?php echo arbee_link( arbee_get( 'cta_button' ), 'expmorebth' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
							</div>
						</div>
						<div class="rgSide">
							<?php if ( arbee_get( 'cta_image' ) ) : ?>
								<div class="imgBx">
									<?php echo arbee_image( arbee_get( 'cta_image' ), array( 'width' => 700, 'height' => 450, 'loading' => 'lazy', 'class' => 'lazy', 'alt' => 'GetInTouch' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</section>
	<?php endif; ?>

</div>
<?php
get_footer();
