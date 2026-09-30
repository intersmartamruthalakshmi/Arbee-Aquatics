<?php
/**
 * Original site content, extracted from the approved PHP templates.
 * Consumed once by Arbee_Importer (inc/importer.php).
 *
 * Line breaks ("\n") correspond to <br> in the original markup.
 * Blank lines ("\n\n") separate paragraphs.
 *
 * @package Arbee
 */

defined( 'ABSPATH' ) || exit;

$link = function ( $title, $url, $target = '' ) {
	return array(
		'title'  => $title,
		'url'    => $url,
		'target' => $target,
	);
};

$country = function ( $name, $flag ) {
	return array(
		'name' => $name,
		'flag' => 'img:' . $flag . '|' . $name . ' flag',
	);
};

$lv = function ( $pairs ) {
	$rows = array();
	foreach ( $pairs as $label => $value ) {
		$rows[] = array(
			'label' => $label,
			'value' => $value,
		);
	}
	return $rows;
};

$factory_paras = "Our manufacturing plant is located in Aroor, on the southern outskirts of Kochi, Kerala — one of India's most productive fishing coastlines. Every fishing harbour that supplies raw material to our factory is within a 25-kilometre radius. This means we receive the freshest possible catch — often within three hours of landing — and begin processing before quality begins to degrade.\n\nIt is this commitment to freshness at the source that gives Arbee Aquatic Proteins a measurable advantage in product quality: lower Total Volatile Basic Nitrogen (TVBN), tighter histamine control, and a more consistent amino acid profile.";

$qualities = array(
	array( 'icon' => 'img:taht1.png', 'text' => 'Quality Assured' ),
	array( 'icon' => 'img:taht2.png', 'text' => 'Responsibly Sourced' ),
	array( 'icon' => 'img:taht3.png', 'text' => 'Fresh Raw Material' ),
	array( 'icon' => 'img:taht4.png', 'text' => 'Years Expertise' ),
	array( 'icon' => 'img:taht5.png', 'text' => 'Global Export Reach' ),
	array( 'icon' => 'img:taht2.png', 'text' => 'Responsibly Sourced' ),
);

$banner_slide = array(
	'video'   => 'file:Nozzles_Syrup.mp4',
	'poster'  => '',
	'title'   => 'Fish Meal & Crude Fish Oil Manufacturer, Exporter',
	'text'    => 'Arbee Aquatic Proteins Pvt Ltd is a Kerala-based exporter of high-protein fish meal and crude fish oil, supplying global markets with GMP Plus, ISO 22000, and Friend of the Sea certifications.',
	'buttons' => array(
		array( 'link' => $link( 'Explore More', 'page:about-us' ) ),
		array( 'link' => $link( 'Request a Quote', '#request-quote' ) ),
	),
);

$grade_text  = 'Arbee Aquatic Super Prime Fish Meal represents the highest specification in our fish meal range — with a minimum protein content of 67%, it is formulated for buyers who demand the very best nutritional density for high-value aquaculture species such as shrimp, salmon, sea bass, and marine finfish.';
$grade_specs = $lv(
	array(
		'Protein'  => '67% Minimum',
		'Fats'     => '10% Maximum',
		'Moisture' => '10% Maximum',
		'Ash'      => '20% Maximum',
		'FFA'      => '10% Maximum',
		'TVBN'     => '120 mg/100g',
	)
);
$grade       = function ( $tab, $name, $spec_title ) use ( $grade_text, $grade_specs, $lv ) {
	return array(
		'tab_label'   => $tab,
		'name'        => $name,
		'title'       => 'Fish Meal',
		'subtitle'    => "The Premium Grade for High-\nPerformance Aquafeed",
		'text'        => $grade_text,
		'spec_title'  => $spec_title,
		'specs'       => $grade_specs,
		'param_title' => 'Parameter Specification',
		'params'      => $lv( array( 'Histamine' => '500 ppm Maximum' ) ),
	);
};

$europe = array();
for ( $i = 0; $i < 5; $i++ ) {
	$europe[] = $country( 'Norway', 'global4.png' );
	$europe[] = $country( 'Spain', 'global5.png' );
	$europe[] = $country( 'Netherlands', 'global6.png' );
}

$node = function ( $icon, $title, $number, $extra = array() ) {
	return array_merge(
		array(
			'icon'   => 'img:' . $icon,
			'title'  => $title,
			'number' => $number,
		),
		$extra
	);
};

$privacy_body = <<<'HTML'
<p>At Arbee, we are committed to respecting and protecting your privacy. This Privacy Policy explains how we collect, use, and protect your personal information when you interact with our website. By accessing and using our website, you agree to the terms outlined in this policy.</p>
<h3>Information We Collect</h3>
<p>We may collect the following types of information:</p>
<ul>
<li>Personal Information: This may include your name, email address, phone number, and any other details you voluntarily provide to us when contacting us, subscribing to our services, or interacting with us on our website.</li>
<li>Non-Personal Information: We also collect information about how you use our website, including actions such as pages visited, time spent on the site, and general website navigation behavior. This data helps us improve our website’s performance and functionality.</li>
</ul>
<ul>
<li>We use the information we collect to: <br>Provide Services: To respond to inquiries, support customer needs, and deliver services that you request. <br>Improve Website Performance: To analyze and improve the functionality, content, and user experience of our website based on usage patterns.</li>
<li>Marketing Communications: If you have opted into receiving communications, we may use your contact information to send you promotional material or updates. You can opt out at any time. <br>Legal Compliance: We may use your data to meet legal obligations and enforce our website’s terms and conditions.</li>
</ul>
<h3>Cookies and Tracking Technologies</h3>
<p>Our website uses cookies and other tracking technologies to enhance your browsing experience. Cookies are small text files stored on your device that help us remember your preferences, improve website functionality, and analyze site usage patterns. <br>By using our website, you consent to the use of these technologies as outlined in this policy. You can control cookie settings through your browser, but disabling cookies may limit your ability to use certain parts of our website</p>
<h3>Analytics and Tracking</h3>
<p>We may use third-party services to analyze how visitors interact with our website. These services collect anonymous data on user behavior, such as pages visited, clicks, and time spent on the site. This information helps us understand how our website is used and improve the user experience. These tools do not collect personally identifiable information unless you provide it voluntarily.</p>
<h3>Data Sharing</h3>
<p>We do not sell, rent, or share your personal information with third parties, except in the following situations:</p>
<ul>
<li>Service Providers: We may share your information with trusted third-party service providers who assist us in operating our website and providing services to you.</li>
<li>Legal Requirements: We may disclose your information if required to do so by law or to comply with legal processes</li>
</ul>
<h3>Data Security</h3>
<p>We implement reasonable security measures to protect your personal data from unauthorized access, alteration, or disclosure. However, no method of data transmission or storage is completely secure, and we cannot guarantee the absolute security of your data.</p>
<h3>Your Rights</h3>
<p>Depending on the jurisdiction you are in, you may have the following rights regarding your personal data:</p>
<ul>
<li>The right to access, update, or delete the information we hold about you.</li>
<li>The right to opt-out of marketing communications.</li>
<li>The right to restrict or object to the processing of your data.</li>
<li>To exercise any of these rights, please contact us using the contact information below.</li>
</ul>
<h3>Third-Party Links</h3>
<p>Our website may contain links to external websites that are not operated by us. We are not responsible for the content or privacy practices of these third-party websites. We encourage you to review their privacy policies before providing any personal information.</p>
<h3>Children’s Privacy</h3>
<p>Our website is not intended for children under the age of 13. We do not knowingly collect personal information from children. If we become aware of any such data, we will take steps to delete it promptly.</p>
<h3>Changes to This Privacy Policy</h3>
<p>We may update this Privacy Policy from time to time. Any changes will be posted on this page with an updated “Effective Date.” We encourage you to review this policy periodically to stay informed about how we protect your information.</p>
<h3>Contact Us</h3>
<p>If you have any questions or concerns about this Privacy Policy or our data practices, please contact us at: <a href="mailto:digital@arbeeglobal.com">digital@arbeeglobal.com</a></p>
HTML;

return array(

	/* ==================================================================
	 * PAGES
	 * ================================================================ */
	'pages'    => array(

		// ---------------- index1.php ----------------
		'home'              => array(
			'title'    => 'Home',
			'template' => '',
			'group'    => 'home',
			'order'    => 0,
			'fields'   => array(
				'banner_slides'      => array( $banner_slide, $banner_slide ),
				'banner_products'    => array(
					array(
						'image'     => 'img:crude1.png|Fish Meal',
						'title'     => 'Fish Meal',
						'link_text' => 'View Product',
						'link'      => $link( 'Fish Meal', 'page:fish-meal' ),
					),
					array(
						'image'     => 'img:crude2.png|Crude Fish Oil',
						'title'     => 'Crude Fish Oil',
						'link_text' => 'View Product',
						'link'      => '',
					),
				),
				'trusted_video'      => 'file:Liquid_Oil.mp4',
				'trusted_image_1'    => 'img:grt1.png',
				'trusted_image_2'    => 'img:grt2.png',
				'trusted_qualities'  => $qualities,
				'trusted_eyebrow'    => 'About',
				'trusted_heading'    => "India's Trusted Fish Meal & Crude Fish Oil Manufacturer",
				'trusted_subheading' => 'Responsibly Sourced. Rigorously Processed. Reliably Delivered.',
				'trusted_text'       => 'Arbee Aquatic Proteins Pvt Ltd is a Kochi-based manufacturer and exporter of high-protein fish meal and sardine crude fish oil, backed by 40+ years of marine industry expertise and serving markets across Asia, Europe, and the Middle East.',
				'trusted_button'     => $link( 'Explore More', 'page:about-us' ),

				'snippet_title'      => 'Product Snippet 2',
				'snippet_text'       => "Renowned globally for producing\nhigh-quality omega-3-rich fish oils, nutrient-dense fish meal Renowned globally for producing",
				'snippet_items'      => array(
					array(
						'image'       => 'img:rapsec1.png|Fish meal',
						'title'       => 'Fish Meal',
						'hover_title' => 'Fish Meal',
						'text'        => 'Grade I and Grade II sardine-sourced crude fish oil — consistent in omega-3 content, low FFA, and microbiologically clean — for feed and industrial use.',
						'link'        => $link( 'Explore Fish Meal', 'page:fish-meal' ),
					),
					array(
						'image'       => 'img:rapsec2.png|Crude fish oil',
						'title'       => 'Crude Fish Oil',
						'hover_title' => 'Crude Fish Oil',
						'text'        => 'Grade I and Grade II sardine-sourced crude fish oil — consistent in omega-3 content, low FFA, and microbiologically clean — for feed and industrial use.',
						'link'        => $link( 'Explore Fish Meal', '#' ),
					),
				),

				'why_items'          => array(
					array( 'icon' => 'img:shields1.png', 'title' => 'Better quality metrics', 'text' => '(low TVBN, histamine control)' ),
					array( 'icon' => 'img:shields2.png', 'title' => 'Freshness advantage', 'text' => '(processed within hours)' ),
					array( 'icon' => 'img:shields3.png', 'title' => 'Strong industry expertise', 'text' => 'Renowned globally for producing high-quality omega-3-rich fish oils' ),
					array( 'icon' => 'img:shields4.png', 'title' => 'Strategic location', 'text' => '' ),
				),
				'why_title'          => 'Why Arbee',
				'why_text'           => 'We sit at the intersection of strategic location, deep industry expertise, and rigorous quality control. Our factory in Aroor, Kochi, receives fresh catches from multiple fishing harbours within a 25 km perimeter — meaning our fish meal is processed from fresher raw material than most competitors can offer. This freshness advantage directly translates into lower TVBN, better histamine control, and higher nutritional value in the finished product.',
				'why_button'         => $link( 'Discover Why Arbee Aquatic', 'page:why-arbee' ),

				'members_title'      => 'Certifications & Memberships',
				'members_text'       => 'Renowned globally for producing high-quality omega-3-rich fish oils, nutrient-dense fish meal globally for producin',
				'members_video'      => 'file:Mauritius_Underw.mp4',
				'members_items'      => array(
					array( 'icon' => 'img:kopt1.png|FDA', 'title' => 'FDA', 'text' => 'Compliant with international food and drug safety standards, reflecting our dedication to consumer health.' ),
					array( 'icon' => 'img:kopt3.png|GMP', 'title' => 'GMP', 'text' => 'Ensures consistent, high-quality manufacturing processes that meet rigorous safety and reliability standards.' ),
					array( 'icon' => 'img:kopt5.png|EU', 'title' => 'EU', 'text' => 'Compliant with international food and drug safety standards, reflecting our dedication to consumer health.' ),
					array( 'icon' => 'img:kopt2.png|HALAL', 'title' => 'HALAL', 'text' => 'Arbee proudly holds Halal Certification, ensuring that all our products meet the strict standards of Halal compliance.' ),
					array( 'icon' => 'img:kopt4.png|IFFO', 'title' => 'IFFO', 'text' => 'Aligned with the global marine ingredient trade association, Arbee upholds sustainable and ethical sourcing practices.' ),
				),

				'globe_title'        => 'Global Presence',
				'globe_text'         => 'Renowned globally for producing high-quality omega-3-rich fish oils, nutrient-dense fish mealRenowned globally for producin',
				'globe_button'       => $link( 'View Our Global Export Markets', 'page:global-exports' ),
				'globe_image'        => 'img:globe.png|Globe',
				'globe_groups'       => array(
					array(
						'icon'      => 'img:rapsec2.png',
						'title'     => 'Fish Oil',
						'subtitle'  => '3 Countries',
						'open'      => 0,
						'countries' => array(
							$country( 'Japan', 'countr1.png' ),
							$country( 'China', 'countr2.png' ),
							$country( 'Vietnam', 'countr3.png' ),
						),
					),
					array(
						'icon'      => 'img:rapsec1.png',
						'title'     => 'Crude Fish Meal',
						'subtitle'  => '6 Countries',
						'open'      => 1,
						'countries' => array(
							$country( 'Japan', 'countr1.png' ),
							$country( 'China', 'countr2.png' ),
							$country( 'Vietnam', 'countr3.png' ),
							$country( 'Taiwan', 'countr4.png' ),
							$country( 'Australia', 'countr5.png' ),
							$country( 'Indonesia', 'countr6.png' ),
						),
					),
				),

				'mfg_title'          => "Manufacturing\nProcess",
				'mfg_text'           => 'Renowned globally for producing high-quality omega-3-rich fish oils, nutrient-dense fish mealRenowned globally for producin',
				'mfg_steps'          => array(
					array( 'icon' => 'img:raws1.png', 'title' => 'Raw Material', 'text' => 'Conservation, reuse & responsible treatment' ),
					array( 'icon' => 'img:raws2.png', 'title' => 'Cooking', 'text' => 'Renewable energy & efficient operations' ),
					array( 'icon' => 'img:raws3.png', 'title' => 'Pressing', 'text' => 'High-quality textiles with a lower impact' ),
					array( 'icon' => 'img:raws4.png', 'title' => 'Drying', 'text' => 'Conservation, reuse & responsible treatment' ),
					array( 'icon' => 'img:raws5.png', 'title' => 'Testing', 'text' => 'Renewable energy & efficient operations' ),
					array( 'icon' => 'img:raws6.png', 'title' => 'Pressing', 'text' => 'High-quality textiles with a lower impact' ),
					array( 'icon' => 'img:raws4.png', 'title' => 'Drying', 'text' => 'Conservation, reuse & responsible treatment' ),
				),

				'ocean_image'        => 'img:fishbgcv.jpg',
				'ocean_title'        => 'Keeping Oceans Blue, Keeping Our Planet <span>Green</span>',
				'ocean_text'         => 'A part of the Arbee Group — a company with over four decades of ecross Japan, China, Vietnam, Taiwan, Australia, Indonesia, and across Asia, Europe and the Middle East.',
				'ocean_button'       => $link( 'LEARN MORE ABOUT US', 'page:about-us' ),
				'ocean_items'        => array(
					array( 'icon' => 'img:tapcop1.png', 'text' => 'Friend of the Sea Certified' ),
					array( 'icon' => 'img:tapcop2.png', 'text' => 'Solar-powered operations' ),
					array( 'icon' => 'img:tapcop3.png', 'text' => 'Waste recycling practices' ),
				),

				'cta_title'          => 'Fish meal & crude fish oil supplier. Contact us for specs, pricing & delivery.',
				'cta_text'           => 'Get in touch with our sales team for specifications, pricing, and delivery details.',
				'cta_button'         => $link( 'REQUEST A QUOTE', '#request-quote' ),
				'cta_image'          => 'img:tapcop4.png',
			),
		),

		// ---------------- about.php ----------------
		'about-us'          => array(
			'title'    => 'About Us',
			'template' => 'page-templates/template-about.php',
			'group'    => 'about',
			'order'    => 1,
			'banner'   => array(
				'banner_image'     => 'img:aboutbg.png',
				'banner_title'     => 'Our Story',
				'banner_subtitle'  => 'Four Decades of Marine Excellence, Built on Trust and Quality.',
				'breadcrumb_home'  => 'Home',
				'breadcrumb_label' => 'About Us',
			),
			'fields'   => array(
				'trusted_video'      => 'file:Liquid_Oil.mp4',
				'trusted_image_1'    => 'img:grt1.png',
				'trusted_image_2'    => 'img:grt2.png',
				'trusted_qualities'  => $qualities,
				'trusted_eyebrow'    => 'About',
				'trusted_heading'    => "Arbee Aquatic\nProteins",
				'trusted_subheading' => "Built on Four Decades of Marine\nIngredients Expertise",
				'trusted_text'       => "Arbee Aquatic Proteins Pvt Ltd was established in 2013 as a dedicated fish meal and fish oil manufacturing entity, expanding the Arbee Group's vertically integrated presence in marine ingredients. The Arbee Group itself traces its origins to 1982, when Mr. P.K. Raju — a veteran of the Indian fish oil industry — founded the business in Kottayam with a clear mission: to supply the world's markets with the highest quality marine-derived ingredients.\n\nOver forty years, the Arbee Group grew from a trading operation into a fully integrated marine ingredients group with manufacturing and distribution presence across India, the UAE, and the Middle East.",
				'trusted_button'     => '',

				'factory_eyebrow'    => 'Aroor, Kochi',
				'factory_title'      => "A Factory Built for\nFreshness",
				'factory_text'       => $factory_paras,
				'factory_image'      => 'img:lorybg.png',

				'group_title'        => "Part of the\nArbee Group",
				'group_intro'        => "Arbee Aquatic Proteins is a\nmember of the Arbee Group,\nwhich also includes",
				'group_logo'         => 'img:shields6.png|Arbee Group',
				'group_text'         => 'This group infrastructure gives Arbee Aquatic Proteins the logistical reach and international credibility to serve export buyers across Asia, Europe, and the Middle East.',
				'group_companies'    => array(
					array( 'image' => 'img:grapbg1.jpg', 'name' => 'Arbee Agencies', 'description' => 'Fish oil trading and distribution', 'url' => '' ),
					array( 'image' => 'img:grapbg2.jpg', 'name' => 'Arbee Biomarine Extracts', 'description' => 'Refined omega-3 concentrates (Mysore & Kottayam)', 'url' => '' ),
					array( 'image' => 'img:grapbg1.jpg', 'name' => 'Arbee Agencies', 'description' => 'Fish oil trading and distribution', 'url' => '' ),
					array( 'image' => 'img:grapbg2.jpg', 'name' => 'Arbee Biomarine Extracts', 'description' => 'Refined omega-3 concentrates (Mysore & Kottayam)', 'url' => '' ),
				),

				'vm_image'           => 'img:aboucg1.png',
				'vm_title'           => 'Our Vision & Mission',
				'vision_icon'        => 'img:binocular1.png',
				'vision_title'       => 'Vision',
				'vision_text'        => 'To be the first-choice marine ingredients partner for aquaculture, animal feed, and industrial buyers across Asia, Europe, and the Middle East — known for uncompromising quality, responsible sourcing, and supply reliability.',
				'mission_icon'       => 'img:targeting1.png',
				'mission_title'      => 'Mission',
				'mission_text'       => 'To manufacture fish meal and crude fish oil of the highest nutritional and quality standards, using sustainably sourced raw material, clean processing practices, and rigorous quality systems — delivering lasting value to buyers, communities, and the marine ecosystem.',

				'nature_title'       => "Nature's Protein\nfor Better Growth",
				'nature_text'        => $factory_paras,
				'nature_image'       => 'img:aboucg2.png',

				'perf_title'         => "Built for Better\nFeed Performance",
				'perf_text'          => $factory_paras,
				'perf_image'         => 'img:aboucg3.png',
			),
		),

		// ---------------- why-arbee.php ----------------
		'why-arbee'         => array(
			'title'    => 'Why Arbee',
			'template' => 'page-templates/template-why-arbee.php',
			'group'    => 'why',
			'order'    => 2,
			'banner'   => array(
				'banner_image'     => 'img:whybgsec.jpg',
				'banner_title'     => 'Why Arbee Aquatic Proteins',
				'banner_subtitle'  => 'Delivering Consistent, Nutrient-Rich Marine Ingredients Trusted Worldwide.',
				'breadcrumb_home'  => 'Home',
				'breadcrumb_label' => 'Why Arbee Aquatic',
			),
			'fields'   => array(
				'fresh_title'         => "The Freshness\nAdvantage From Sea to\nFactory in Under 3 Hours",
				'fresh_text'          => "Most fish meal and fish oil manufacturers work with raw material that has travelled significant distances before reaching the processing floor. At Arbee Aquatic Proteins, our factory in Aroor, Kochi, is surrounded by a network of active fishing harbours — all within a 25-kilometre radius. This means our raw material arrives fresh, often within three hours of landing, and processing begins before quality deterioration can take hold.\n\nThe direct impact of this freshness is measurable:",
				'fresh_items'         => array(
					array( 'title' => 'Lower TVBN', 'text' => 'Minimal volatile basic nitrogen ensures optimal freshness.' ),
					array( 'title' => 'Histamine Control', 'text' => 'Rigorous cold-chain management limits bio-amine formation.' ),
					array( 'title' => 'Nutritional Value', 'text' => 'Flash processing preserves critical bio-available proteins.' ),
					array( 'title' => 'Consistent Amino', 'text' => 'Locked-in nutritional profiles across every batch.' ),
				),
				'fresh_image'         => 'img:whybgfop.jpg',

				'exp_title'           => 'Four Decades of Group Expertise',
				'exp_text'            => 'Arbee Aquatic Proteins operates within the Arbee Group — an organisation that has been active in the marine ingredients industry since 1982. That institutional knowledge, supplier network, and understanding of international quality requirements is embedded in every aspect of how we operate.',
				'exp_cert_title'      => 'Certified at Every Level',
				'exp_certs'           => array(
					array( 'title' => 'GMP Plus Certified', 'text' => 'the global food safety system benchmark' ),
					array( 'title' => 'EU Approved Unit', 'text' => 'Certified for EU Exports' ),
					array( 'title' => 'ISO 22000:2018', 'text' => 'International food safety management' ),
					array( 'title' => 'IFFO Member', 'text' => 'Member of IFFO' ),
					array( 'title' => 'Friend of the Sea (FOS)', 'text' => 'sustainable wild fisheries certification' ),
				),

				'export_title'        => "Export-Ready\nSupply Chain",
				'export_text'         => 'Our team manages end-to-end export documentation, Global compliance, phytosanitary certification, and international shipping coordination. Whether you are in Japan, Vietnam, Indonesia, or Europe, Arbee Aquatic Proteins can supply to your port of choice with full documentation.',
				'export_checklist'    => array(
					array( 'text' => 'End-to-end documentation & traceability' ),
					array( 'text' => 'Full compliance with EU & Asian import standards' ),
					array( 'text' => 'Dedicated export-grade heavy-duty packaging' ),
				),
				'export_global_icon'  => 'img:globalbg1.png',
				'export_global_title' => 'Global Distribution',
				'export_global_text'  => 'Supporting aquaculture and animal nutrition globally.',

				'quality_title'       => 'Our Quality Commitments',
				'quality_text'        => 'Every batch of fish meal and crude fish oil produced at Arbee Aquatic Proteins is subjected to rigorous in-house laboratory testing across physical, chemical, and microbiological parameters before dispatch. Key quality controls include:',
				'quality_col1'        => 'Analysis Category',
				'quality_col2'        => 'Test Parameters',
				'quality_rows'        => $lv(
					array(
						'Protein Profile'   => 'Protein content (Kjeldahl), Amino Acid Profile',
						'Physical & Yield'  => 'Moisture, Ash, Total Fat, FFA',
						'Freshness Indices' => 'TVBN, Histamine, Peroxide Value, Acid Value',
						'Microbial Screen'  => 'TPC, Yeast & Molds, E-coli, Salmonella',
					)
				),
				'quality_note'        => 'Staffed by experienced marine ingredient technicians and ISO-certified laboratory protocols.',

				'benefits'            => array(
					array( 'icon' => 'img:globalbg2.png', 'title' => 'High Protein Content', 'text' => 'Fish Meal Delivers High-Quality Protein, Essential Amino Acids, And Vital Nutrients.' ),
					array( 'icon' => 'img:globalbg3.png', 'title' => 'Rich in Essential Nutrients', 'text' => 'Provides Calcium, Zinc, And Magnesium For Optimal Health.' ),
					array( 'icon' => 'img:globalbg4.png', 'title' => 'Superior Digestibility', 'text' => 'Enhances nutrient absorption and promotes better feed efficiency.' ),
					array( 'icon' => 'img:globalbg5.png', 'title' => 'Improves Performance', 'text' => 'Promotes faster growth and stronger animal health.' ),
				),
				'meal_title'          => "Advantage of\nfish meals",
				'meal_text'           => 'Fish meal delivers high-quality protein, essential amino acids, and vital nutrients that promote faster growth, better feed efficiency, and stronger animal health.',

				'cert_title'          => 'Certifications',
				// The original's 6th slide repeated globalbg8 only to fill the loop; the template now handles that.
				'cert_logos'          => array( 'img:globalbg6.png', 'img:globalbg7.png', 'img:globalbg8.png', 'img:globalbg9.png', 'img:globalbg10.png' ),
			),
		),

		// ---------------- fish-meal.php ----------------
		'fish-meal'         => array(
			'title'    => 'Fish Meal',
			'template' => 'page-templates/template-fish-meal.php',
			'group'    => 'fishmeal',
			'order'    => 3,
			'banner'   => array(
				'banner_image'       => 'img:fishpgbg.png',
				'banner_title'       => 'Fish Meal',
				'banner_subtitle'    => 'Premium marine protein for healthier growth and better feed efficiency.',
				'breadcrumb_home'    => 'Home',
				'breadcrumb_parents' => array( array( 'label' => 'Products', 'url' => '#' ) ),
				'breadcrumb_label'   => 'Fish Meal',
			),
			'fields'   => array(
				'intro_title'      => "High-Protein Fish Meal\nManufacturer & Exporter, India",
				'intro_subtitle'   => 'Sardine-Sourced. Steam-Dried. Nutritionally Superior.',
				'intro_text'       => "Arbee Aquatic Proteins manufactures steam-dried fish meal from Indian Sardine (Sardinella longiceps) — one of the most nutritionally complete and sustainably abundant pelagic species in the Indian Ocean. Our fish meal is produced at our factory in Aroor, Kochi, where raw material is received fresh from surrounding fishing harbours within a 25-kilometre radius — ensuring that the quality of the raw material is protected from the moment of landing.\n\nOur fish meal product range covers three protein grades, each formulated to meet specific buyer requirements across aquaculture feed, poultry feed, and livestock feed applications.",
				'intro_image'      => 'img:fishpg1.png',
				'range_title'      => 'Our Product Range',
				'grades'           => array(
					$grade( 'Super Prime Fish Meal', 'Super Prime', 'Super Prime Fish Meal — 67% Minimum Protein' ),
					$grade( 'Prime Fish Meal', 'Prime', 'Prime Fish Meal — 63% Minimum Protein' ),
					$grade( 'Standard Fish Meal', 'Standard', 'Standard Fish Meal — 62% Minimum Protein' ),
				),

				'source_image'     => 'img:mealkrop1.png',
				'source_title'     => 'Source Species',
				'source_subtitle'  => 'Indian Sardine (Sardinella Longiceps)',
				'source_text'      => "Our products are manufactured using carefully selected marine fish species, primarily sardines, along with other nutrient-rich pelagic fish sourced from trusted fishing harbours along the Kerala coast. These species are naturally rich in high-quality protein, essential amino acids, and healthy marine oils, making them ideal for premium fish meal and fish oil production.\n\nEvery batch of raw material is inspected for freshness and quality before processing. By sourcing fish from nearby landing centres, we minimize transportation time, helping preserve nutritional integrity while ensuring low TVBN, controlled histamine levels, and consistent product performance.",

				'pack_icon'        => 'img:packdf1.png',
				'pack_title'       => 'Packaging',
				'pack_subtitle'    => 'We have a variety of package sizes available:',
				'pack_sizes'       => array(
					array( 'icon' => 'img:packdf2.png', 'weight' => '25 Kg', 'type' => 'PP Bags' ),
					array( 'icon' => 'img:packdf3.png', 'weight' => '50 Kg', 'type' => 'PP Bags' ),
					array( 'icon' => 'img:packdf4.png', 'weight' => '700 - 1000 Kg', 'type' => 'Bulk Bags' ),
				),
				'pack_meta'        => $lv(
					array(
						'MoQ:'                    => '15,000 Kg',
						'Transportation Options:' => 'Sea, Road',
					)
				),

				'cert_icon'        => 'img:packdf1.png',
				'cert_title'       => 'Certifications',
				'cert_subtitle'    => 'Certified for Quality and Trust',
				'cert_logos'       => array(
					array( 'logo' => 'img:packdf5.png', 'url' => '' ),
					array( 'logo' => 'img:packdf6.png', 'url' => '' ),
					array( 'logo' => 'img:packdf7.png', 'url' => '' ),
					array( 'logo' => 'img:packdf8.png', 'url' => '' ),
					array( 'logo' => 'img:packdf5.png', 'url' => '' ),
					array( 'logo' => 'img:packdf6.png', 'url' => '' ),
					array( 'logo' => 'img:packdf7.png', 'url' => '' ),
					array( 'logo' => 'img:packdf8.png', 'url' => '' ),
				),

				'process_title'    => 'Processing Method',
				'process_subtitle' => 'A Hygienic Process, Every Step of the Way',
				'process_steps'    => array(
					array( 'icon' => 'img:pross1.png', 'title' => 'Raw fish', 'text' => 'Indian oil sardine' ),
					array( 'icon' => 'img:pross2.png', 'title' => "Metal\ndetector", 'text' => 'Indian oil sardine' ),
					array( 'icon' => 'img:pross3.png', 'title' => 'Cooker', 'text' => 'Indian oil sardine' ),
					array( 'icon' => 'img:pross4.png', 'title' => "Mechanical\npress", 'text' => 'Indian oil sardine' ),
				),
				'process_button'   => $link( 'VIEW ALL PROCESS', 'page:technology-process' ),

				'markets_title'    => 'Export Markets Fish Meal',
				'markets_text'     => 'Arbee Aquatic Proteins exports fish meal to buyers across Asia-Pacific and Oceania, including:',
				'markets'          => array(
					$country( 'Japan', 'marketg1.png' ),
					$country( 'China', 'marketg2.png' ),
					$country( 'Vietnam', 'marketg3.png' ),
					$country( 'Taiwan', 'marketg4.png' ),
					$country( 'Australia', 'marketg5.png' ),
					$country( 'Indonesia', 'marketg6.png' ),
				),

				'uses_title'       => 'Our fish meal is widely used in:',
				'uses'             => array(
					array( 'title' => 'Shrimp and prawn aquafeed', 'text' => 'primary application in Vietnam, Indonesia, and Taiwan' ),
					array( 'title' => 'Salmonid and marine finfish feed', 'text' => '(Japan, Australia)' ),
					array( 'title' => 'Poultry and swine feed', 'text' => '(China, regional)' ),
				),
				'apps_title'       => 'Applications',
				'apps'             => array(
					array( 'icon' => 'img:marketg7.png', 'text' => 'Shrimp & prawn aquaculture feed' ),
					array( 'icon' => 'img:marketg8.png', 'text' => 'Salmon, tuna, and sea bass aquafeed' ),
					array( 'icon' => 'img:marketg9.png', 'text' => 'Poultry feed (broiler and layer)' ),
					array( 'icon' => 'img:marketg10.png', 'text' => 'Swine and cattle feed' ),
					array( 'icon' => 'img:marketg11.png', 'text' => 'Pet food formulations' ),
				),

				'cta_title'        => 'Secure Your Supply Chain Today',
				'cta_text'         => "Get in touch with our technical sales team for bulk quotes, sample\nrequests, or specific custom grade formulations.",
				'cta_button'       => $link( 'Request a Sample or Quote', '#request-quote' ),

				'keywords'         => 'fish meal manufacturer India | fish meal exporter Kerala | high protein fish meal | sardine fish meal India | fish meal for aquaculture | fish meal supplier Japan China Vietnam Taiwan Australia Indonesia | 67% protein fish meal | 65% protein fish meal | fish meal 62% protein India',
			),
		),

		// ---------------- technology.php ----------------
		'technology-process' => array(
			'title'    => 'Technology & Process',
			'template' => 'page-templates/template-technology.php',
			'group'    => 'tech',
			'order'    => 4,
			'banner'   => array(
				'banner_image'     => 'img:techbg.jpg',
				'banner_title'     => 'Technology & Process',
				'banner_subtitle'  => 'Advanced processing techniques ensure consistent quality, safety, and nutritional value in every batch.',
				'breadcrumb_home'  => 'Home',
				'breadcrumb_label' => 'Technology & Process',
			),
			'fields'   => array(
				'intro_title'    => "Fish Meal & Fish Oil\nManufacturing Process\nArbee Aquatic Proteins, Kerala",
				'intro_text'     => 'A look at how Arbee Aquatic Proteins produces high-quality fish meal and crude fish oil — from fresh sardine landing to steam-dried meal and pressed crude oil — with quality checks at every stage.',
				'process_title'  => "How We Make It — The Fish Meal\n& Fish Oil Process",
				'raw_fish'       => $node( 'techic1.png', 'Raw fish', '01', array( 'subtitle' => 'Indian oil sardine' ) ),
				'metal_detector' => $node( 'techic2.png', "Metal\ndetector", '02' ),
				'cooker'         => $node(
					'techic3.png',
					'Cooker',
					'03',
					array(
						'popup_title' => 'Cooker',
						'popup_text'  => 'Raw fish are fed into the cooker where indirect steam cooking at controlled temperatures extracts oil and water from the fish mass while preserving protein integrity.',
					)
				),
				'press'          => $node( 'techic4.png', "Mechanical\npress", '04' ),
				'press_liquid'   => $node( 'techic5.png', 'Press liquid', '05' ),
				'decanter'       => $node( 'techic6.png', 'Decanter', '06' ),
				'oil_separator'  => $node( 'techic9.png', "Oil\nSeparator", '07' ),
				'oil'            => $node( 'techic10.png', 'Oil', '08' ),
				'crude_oil'      => $node( 'techic13.png', 'Crude Fish Oil', '' ),
				'press_cake'     => $node( 'techic7.png', 'Press cake', '05' ),
				'dryer'          => $node( 'techic8.png', 'Dryer', '06' ),
				'hammer_mill'    => $node( 'techic12.png', 'Hammer mill', '07' ),
				'cooler'         => $node( 'techic11.png', 'Cooler', '08' ),
				'siever'         => $node( 'techic14.png', 'siever', '09' ),
				'fish_meal'      => $node( 'techic15.png', 'Fish meal', '' ),
			),
		),

		// ---------------- sustainability.php ----------------
		'sustainability'    => array(
			'title'    => 'Sustainability',
			'template' => 'page-templates/template-sustainability.php',
			'group'    => 'sustain',
			'order'    => 5,
			'banner'   => array(
				'banner_image'     => 'img:sustainbg.jpg',
				'banner_title'     => 'Sustainability',
				'banner_subtitle'  => 'Committed to responsible sourcing and environmentally conscious production.',
				'breadcrumb_home'  => 'Home',
				'breadcrumb_label' => 'Sustainability',
			),
			'fields'   => array(
				'intro_title'    => "Sustainability\nKeeping Oceans <span class=\"blueclrgat\">Blue</span>, Keeping\nOur Planet <span class=\"greenclrgat\">Green</span>",
				'intro_subtitle' => 'Responsibly Sourced Raw Material',
				'intro_text'     => "Arbee Aquatic Proteins sources raw material exclusively from low life-span, fast-regenerating pelagic species — primarily Indian Sardine (Sardinella longiceps), Indian Scad, and Mackerel. The fast-growing lifecycle of these species classifies them as ecologically sustainable, and their abundance along the Kerala coastline ensures responsible harvesting without ecological pressure on the stock.\n\nWe source exclusively from responsibly managed fisheries and hold the Friend of the Sea (FOS) Wild Certification — an internationally recognised scheme that verifies sustainable wild-capture sourcing.",
				'intro_image'    => 'img:sustain1.png',
				'clean_title'    => "Clean Manufacturing\nPractices",
				'clean_text'     => 'Environmental responsibility extends into our manufacturing operations. Arbee Aquatic Proteins employs the latest technology in solid and liquid waste recycling within our plant — significantly reducing the environmental footprint of fish meal and fish oil production. Our manufacturing units operate substantially on solar power, meeting a major share of our electricity requirements from renewable energy.',
				'clean_items'    => array(
					array( 'icon' => 'img:sustain2.png', 'title' => 'Waste Recycling', 'text' => 'Our advanced technological systems ensure maximum recovery of secondary resources from all processing streams.' ),
					array( 'icon' => 'img:sustain3.png', 'title' => 'Solar Powered', 'text' => 'Our manufacturing units operate substantially on solar power, meeting a major share of our electricity requirements from renewable energy.' ),
				),
				'commit_title'   => 'Our Sustainability Commitments',
				'commitments'    => array(
					array( 'title' => 'Certified Sourcing', 'text' => "Source only from sustainable,\ncertified fisheries" ),
					array( 'title' => 'FOS Certification', 'text' => "Maintain Friend of the Sea\n(FOS) Wild Certification" ),
					array( 'title' => 'Renewable Energy', 'text' => "Operate solar-powered\nmanufacturing units" ),
					array( 'title' => 'Waste Upcycling', 'text' => "Recycle solid and liquid\nprocess waste" ),
					array( 'title' => 'Stock Protection', 'text' => "No sourcing from over-\nexploited fish stocks" ),
					array( 'title' => 'Full Traceability', 'text' => "Full supply chain traceability\nfrom vessel to product" ),
				),
			),
		),

		// ---------------- global-exports.php ----------------
		'global-exports'    => array(
			'title'    => 'Global Exports',
			'template' => 'page-templates/template-global-exports.php',
			'group'    => 'global',
			'order'    => 6,
			'banner'   => array(
				'banner_image'     => 'img:globalbg.jpg',
				'banner_title'     => 'Global Exports Indian Marine Ingredients',
				'banner_subtitle'  => 'Delivering premium marine ingredients to customers across international markets.',
				'breadcrumb_home'  => 'Home',
				'breadcrumb_label' => 'Global Exports',
			),
			'fields'   => array(
				'fm_title'    => "Fish Meal\nExport Markets",
				'fm_text'     => 'Arbee Aquatic Proteins exports high-protein fish meal — in Super Prime (67%), Prime (65%), and Standard (62%) grades — to buyers across Asia-Pacific and Oceania.',
				'fm_grades'   => array(
					array( 'text' => '67% Super Prime' ),
					array( 'text' => '65% Prime' ),
					array( 'text' => '62% Standard' ),
				),
				'fm_col1'     => 'Country',
				'fm_col2'     => 'Primary Use',
				'fm_rows'     => $lv(
					array(
						'Japan'     => 'Premium aquafeed, marine finfish',
						'China'     => 'Shrimp, poultry, swine feed',
						'Vietnam'   => 'Shrimp aquafeed',
						'Taiwan'    => 'Aquaculture and compound feed',
						'Australia' => 'Premium aquafeed, pet food',
						'Indonesia' => 'Shrimp and fish aquaculture',
					)
				),
				'oil_title'   => 'Crude Fish Oil Export Markets',
				'oil_text'    => "Our sardine-sourced crude fish oil (Grade I and Grade II) is exported to buyers across three broad regions, meeting\nrigorous technical specifications for diverse industrial uses.",
				'oil_regions' => array(
					array(
						'map'       => 'img:globalmap1.png',
						'name'      => 'Asia-Pacific',
						'countries' => array(
							$country( 'Thailand', 'global1.png' ),
							$country( 'South Korea', 'global2.png' ),
							$country( 'Philippines', 'global3.png' ),
						),
					),
					array(
						'map'       => 'img:globalmap2.png',
						'name'      => 'Europe',
						'countries' => $europe,
					),
					array(
						'map'       => 'img:globalmap3.png',
						'name'      => 'Middle East',
						'countries' => array(
							$country( 'UAE', 'global7.png' ),
							$country( 'Saudi Arabia', 'global8.png' ),
							$country( 'Oman', 'global9.png' ),
						),
					),
				),
				'apps_title'  => 'Applications in export markets',
				'apps'        => array(
					array( 'icon' => 'img:globalic1.png', 'text' => "Aquafeed lipid\ninclusion" ),
					array( 'icon' => 'img:globalic2.png', 'text' => "Compound feed fat\nsupplement" ),
					array( 'icon' => 'img:globalic3.png', 'text' => "Oleochemical\nprocessing inputs" ),
					array( 'icon' => 'img:globalic4.png', 'text' => "Pet food\nformulation" ),
				),
				'log_image'   => 'img:globalsecbg.jpg',
				'log_title'   => "Export Logistics &\nDocumentation Support",
				'log_text'    => 'Arbee Aquatic Proteins provides full export documentation support, ensuring seamless customs clearance and compliance with international trade regulations for every shipment.',
				'log_docs'    => array(
					array( 'icon' => 'img:globalic5.png', 'text' => "Certificate of\nAnalysis (COA)" ),
					array( 'icon' => 'img:globalic6.png', 'text' => "Phytosanitary\nCertificate" ),
					array( 'icon' => 'img:globalic7.png', 'text' => 'Bill of Lading' ),
					array( 'icon' => 'img:globalic8.png', 'text' => 'Packing List' ),
					array( 'icon' => 'img:globalic9.png', 'text' => "Commercial\nInvoice" ),
					array( 'icon' => 'img:globalic10.png', 'text' => "Health Certificate\nAssistance" ),
				),
				'cta_title'   => 'Ready for Export?',
				'cta_text'    => "Partner with India's leading marine protein producer for reliable, high-\nquality, and fully documented protein exports.",
				'cta_button'  => $link( 'Get in touch to discuss your import requirements', 'page:contact-us' ),
			),
		),

		// ---------------- contact.php ----------------
		'contact-us'        => array(
			'title'    => 'Contact Us',
			'template' => 'page-templates/template-contact.php',
			'group'    => 'contact',
			'order'    => 7,
			'banner'   => array(
				'banner_image'     => 'img:contactbg1.jpg',
				'banner_title'     => 'Contact Us',
				'banner_subtitle'  => 'Connect with our team for inquiries, partnerships, and product information.',
				'breadcrumb_home'  => 'Home',
				'breadcrumb_label' => 'Contact Us',
			),
			'fields'   => array(
				'form_title'          => 'Request a Quote',
				'form_text'           => 'Please provide the following details to receive a comprehensive pricing proposal and technical data sheet.',
				'form_label_name'     => 'Full Name *',
				'form_ph_name'        => 'Enter your full name',
				'form_label_phone'    => 'Phone *',
				'form_ph_phone'       => 'Enter your phone number',
				'form_codes'          => "+91\n+92\n+93\n+94",
				'form_label_email'    => 'Email*',
				'form_ph_email'       => 'Enter your email address',
				'form_label_topic'    => 'What do you want to know about? *',
				'form_topics'         => "General Enquiry\nNormal Enquiry",
				'form_label_comments' => 'Comments',
				'form_ph_comments'    => 'Message',
				'form_submit'         => 'enquire now',

				'touch_title'         => "Get in\nTouch",
				'touch_text'          => 'Our team is ready to assist you with reliable solutions.',
				'factory_icon'        => 'img:contactbg3.png',
				'factory_title'       => 'Factory',
				'factory_address'     => "Arbee Aquatic Proteins Pvt Ltd\nAP11/723, Industrial Development Area\nAroor, Alleppey 688534",
				'touch_items'         => array(
					array( 'icon' => 'img:contactbg4.png', 'title' => 'Headquarters', 'value' => 'Kottayam, Kerala, India', 'url' => '' ),
					array( 'icon' => 'img:contactbg5.png', 'title' => 'Email', 'value' => 'marketing@arbeeaquatic.com', 'url' => 'mailto:marketing@arbeeaquatic.com' ),
					array( 'icon' => 'img:contactbg6.png', 'title' => 'Phone', 'value' => '04829 237430', 'url' => 'tel:+914829237430' ),
					array( 'icon' => 'img:contactbg7.png', 'title' => 'Website', 'value' => 'www.arbeeaquatic.com', 'url' => '' ),
				),

				'careers_title'       => 'Shape Your Future with Arbee Group',
				'careers_text'        => 'Join a dynamic organization where innovation, collaboration, and continuous growth are at the heart of everything we do. Explore opportunities across our group companies.',
				'careers_button'      => $link( 'Explore Opportunities', '#' ),
				'careers_image'       => 'img:contactbg2.png',
			),
		),

		// ---------------- privacy.php ----------------
		'privacy-policy'    => array(
			'title'    => 'Privacy Policy',
			'template' => 'page-templates/template-privacy.php',
			'group'    => 'legal',
			'order'    => 8,
			'banner'   => array(
				'banner_image'     => 'img:privacybg.jpg',
				'banner_title'     => '',
				'banner_subtitle'  => '',
				'breadcrumb_home'  => 'Home',
				'breadcrumb_label' => 'Privacy Policy',
			),
			'fields'   => array(
				'legal_title' => 'Privacy Policy',
				'legal_date'  => 'Effective Date: 01/03/2025, Saturday',
				'legal_body'  => $privacy_body,
			),
		),
	),

	/* ==================================================================
	 * THEME SETTINGS (includes/header.php + includes/footer.php)
	 * ================================================================ */
	'options'  => array(
		'header_logo'             => 'img:logo.png|Arbee Aquatic',
		'header_quote_label'      => 'REQUEST A QUOTE',

		'footer_logo'             => 'img:footerlogo.png|Arbee Aquatic',
		'footer_about'            => 'At Arbee, quality drives everything we do—from advanced R&D to world-class manufacturing—delivering refined Omega-3 fish oil and nutrient-rich fish meals that meet global standards.',
		'footer_company_title'    => 'Company',
		'footer_products_title'   => 'Our Products',
		'footer_map'              => array(
			'icon'  => 'img:map.png',
			'label' => 'GOOGLE MAP',
			'url'   => 'https://www.google.com/maps/search/?api=1&query=Arbee+Aquatic+Proteins+Pvt+Ltd+Thalayolaparambu+Kottayam+Kerala',
		),
		'hq_title'                => 'headquarters',
		'hq_address'              => "Arbee Aquatic Proteins Pvt Ltd\n405/IX, Karippadom P.O,\nThalayolaparambu,\nKottayam, Kerala\nIndia — 686605",
		'hq_phone'                => array(
			'icon'   => 'img:phonebg.png',
			'label'  => '+91 482 9237430',
			'number' => '+914829237430',
		),
		'hq_email'                => array(
			'icon'    => 'img:emailbg.png',
			'address' => 'digital@arbeeglobal.com',
		),
		'footer_certifications'   => array(
			array( 'logo' => 'img:Goals1.png|Arbee Group', 'url' => '' ),
			array( 'logo' => 'img:Goals2.png|Arbee Group', 'url' => '' ),
			array( 'logo' => 'img:Goals3.png|Arbee Group', 'url' => '' ),
			array( 'logo' => 'img:Goals4.png|Sustainable Development Goals', 'url' => '' ),
		),
		'footer_social'           => array(
			array( 'icon' => 'img:Social1.png', 'label' => 'Facebook', 'url' => '' ),
			array( 'icon' => 'img:Social2.png', 'label' => 'Instagram', 'url' => '' ),
			array( 'icon' => 'img:Social3.png', 'label' => 'LinkedIn', 'url' => '' ),
			array( 'icon' => 'img:Social4.png', 'label' => 'YouTube', 'url' => '' ),
		),
		'copyright'               => array(
			'company' => 'Arbee aquatic',
			'url'     => 'home:',
			'suffix'  => 'All rights reserved.',
		),
		'credit'                  => array(
			'prefix' => 'Designed & Developed By:',
			'logo'   => 'img:inter.png|Intersmart',
			'name'   => 'intersmart',
			'url'    => 'https://www.intersmart.in',
		),

		'floating_quote_label'    => 'REQUEST A QUOTE',
		'floating_phone'          => '+914829237430',
		'floating_email'          => 'digital@arbeeglobal.com',

		'quote_title'             => 'Request a Quote',
		'quote_image'             => 'img:popimage.png',
		'quote_label_name'        => 'Full Name *',
		'quote_ph_name'           => 'Enter your full name',
		'quote_label_code'        => 'Country Code*',
		'quote_label_phone'       => 'Phone Number*',
		'quote_ph_phone'          => 'Enter your phone number',
		'quote_label_email'       => 'Email*',
		'quote_ph_email'          => 'Enter your email address',
		'quote_label_topic'       => 'What do you want to know about?*',
		'quote_topic_placeholder' => 'General Enquiry',
		'quote_topics'            => "Demo1\nDemo2\nDemo3",
		'quote_label_comments'    => 'Comments',
		'quote_ph_comments'       => 'Message',
		'quote_submit'            => 'SUBMIT',

		'enquiry_recipients'      => '',
		'enquiry_success_message' => 'Thank you! Your enquiry has been sent. Our team will get back to you shortly.',

		'seo_default_description' => 'Arbee Aquatic Proteins Pvt Ltd is a Kerala-based manufacturer and exporter of high-protein fish meal and crude fish oil, supplying global markets with GMP Plus, ISO 22000, and Friend of the Sea certifications.',
		'seo_author'              => 'INTER SMART | Web Design & Development Company | Kerala',
		'seo_default_og_image'    => 'img:fishpgbg.png',

		'e404_image'              => 'img:arbee-1.png',
		'e404_title'              => 'Page Not Found',
		'e404_text'               => 'The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.',
		'e404_button'             => $link( 'Back to Home', 'home:' ),
	),

	/* ==================================================================
	 * MENUS (includes/header.php + includes/footer.php)
	 * ================================================================ */
	'menus'    => array(
		'primary'         => array(
			'name'  => 'Header Menu',
			'items' => array(
				array( 'title' => 'HOME', 'page' => 'home' ),
				array( 'title' => 'ABOUT US', 'page' => 'about-us' ),
				array( 'title' => 'WHY ARBEE', 'page' => 'why-arbee' ),
				array(
					'title'    => 'PRODUCTS',
					'url'      => '#',
					'children' => array(
						array( 'title' => 'Fish Meal', 'page' => 'fish-meal', 'icon' => 'img:navimg1.png' ),
						array( 'title' => 'Crude Fish Oil', 'url' => '#', 'icon' => 'img:navimg2.png' ),
					),
				),
				array( 'title' => 'TECHNOLOGY & PROCESS', 'page' => 'technology-process' ),
				array( 'title' => 'SUSTAINABILITY', 'page' => 'sustainability' ),
				array( 'title' => 'GLOBAL EXPORTS', 'page' => 'global-exports' ),
				array( 'title' => 'CONTACT US', 'page' => 'contact-us' ),
			),
		),
		'footer_company'  => array(
			'name'  => 'Footer: Company',
			'items' => array(
				array( 'title' => 'About', 'page' => 'about-us' ),
				array( 'title' => 'Why Arbee', 'page' => 'why-arbee' ),
				array( 'title' => 'Technology & Process', 'page' => 'technology-process' ),
				array( 'title' => 'Sustainability', 'page' => 'sustainability' ),
				array( 'title' => 'Global Exports', 'page' => 'global-exports' ),
				array( 'title' => 'Contact us', 'page' => 'contact-us' ),
			),
		),
		'footer_products' => array(
			'name'  => 'Footer: Our Products',
			'items' => array(
				array( 'title' => 'Fish Meal', 'page' => 'fish-meal' ),
				array( 'title' => 'Crude Fish Oil', 'url' => '#' ),
			),
		),
		'footer_legal'    => array(
			'name'  => 'Footer: Legal',
			'items' => array(
				array( 'title' => 'Privacy', 'page' => 'privacy-policy' ),
				array( 'title' => 'Terms & Conditions', 'url' => '#' ),
			),
		),
	),

	/* ==================================================================
	 * WORDPRESS SETTINGS
	 * ================================================================ */
	'settings' => array(
		'blogname'        => 'Arbee Aquatic',
		'blogdescription' => 'Fish Meal & Crude Fish Oil Manufacturer, Exporter',
	),
);
