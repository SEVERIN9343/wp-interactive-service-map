<?php
/*
Plugin Name: WP Interactive Service Map
Description: Carte interactive WordPress avec zones d’intervention, géolocalisation, calcul de distances et liens Google Maps.
Version: 1.0.0
Author: Sévérin OGAH
*/

if (!defined('ABSPATH')) {
    exit;
}

function wism_enqueue_assets() {
    wp_enqueue_style(
        'wism-service-map-style',
        plugin_dir_url(__FILE__) . 'assets/css/service-map.css',
        array(),
        '1.0.0'
    );

    wp_enqueue_script(
        'wism-service-map-script',
        plugin_dir_url(__FILE__) . 'assets/js/service-map.js',
        array(),
        '1.0.0',
        true
    );
}
add_action('wp_enqueue_scripts', 'wism_enqueue_assets');

function wism_render_service_map() {
    ob_start();
    ?>

    <section class="zeb-zone" id="zone-intervention">
      <div class="zeb-zone__inner">
        <header class="zeb-zone__head">
          <h2 class="zeb-zone__title">Zone d’intervention</h2>
          <p class="zeb-zone__subtitle">
            Nous intervenons à N’Djamena et dans les principales villes du Tchad ainsi que leurs périphéries.
            Survolez ou cliquez une ville pour voir les détails et la distance depuis notre agence.
          </p>
        </header>

        <div class="zeb-zone__layout">
          <div class="zeb-map" aria-label="Carte interactive du Tchad">
            <svg class="zeb-map__svg" viewBox="0 0 520 720" role="img" aria-labelledby="zebMapTitle zebMapDesc">
              <title id="zebMapTitle">Carte du Tchad — villes d’intervention</title>
              <desc id="zebMapDesc">Carte stylisée du Tchad avec des points cliquables représentant les principales villes.</desc>

              <rect x="0" y="0" width="520" height="720" rx="18" ry="18" class="zeb-map__bg"></rect>

              <path class="zeb-map__country" d="M215,48
                L315,78 L410,50 L490,128
                L465,250 L470,360 L444,420
                L455,520 L410,620 L350,690
                L260,670 L200,710 L135,650
                L125,560 L82,470 L60,405
                L90,290 L150,210 L190,140 Z" />

              <path class="zeb-map__lines" d="M160,220 L420,250 M120,420 L450,380 M210,120 L360,660 M110,560 L320,660" />

              <g class="zeb-pin zeb-pin--agency" tabindex="0"
                 role="button"
                 aria-label="Agence VPC Expert à N’Djamena"
                 data-type="agency"
                 data-city="Agence (VPC Expert)"
                 data-lat="12.10465355754795"
                 data-lng="15.069451878272364"
                 data-address="433F+VP N’Djamena, Tchad"
                 data-gmaps="https://maps.app.goo.gl/2GLzWVoLRHXygPiA9">
                <circle cx="108" cy="392" r="10"></circle>
                <circle cx="108" cy="392" r="18" class="zeb-pin__pulse"></circle>
              </g>

              <g class="zeb-pin" tabindex="0" role="button"
                 aria-label="Ville : N’Djamena"
                 data-type="city"
                 data-city="N’Djamena"
                 data-note="Capitale, centre politique, économique et administratif."
                 data-lat="12.1348" data-lng="15.0557"
                 data-gmaps="https://www.google.com/maps?q=12.1348,15.0557">
                <circle cx="112" cy="382" r="7"></circle>
              </g>

              <g class="zeb-pin" tabindex="0" role="button"
                 aria-label="Ville : Moundou"
                 data-type="city"
                 data-city="Moundou"
                 data-note="Deuxième plus grande ville, pôle économique et industriel."
                 data-lat="8.5667" data-lng="16.0833"
                 data-gmaps="https://www.google.com/maps?q=8.5667,16.0833">
                <circle cx="170" cy="535" r="7"></circle>
              </g>

              <g class="zeb-pin" tabindex="0" role="button"
                 aria-label="Ville : Sarh"
                 data-type="city"
                 data-city="Sarh"
                 data-note="Grand centre agricole du sud."
                 data-lat="9.1500" data-lng="18.3830"
                 data-gmaps="https://www.google.com/maps?q=9.15,18.383">
                <circle cx="275" cy="520" r="7"></circle>
              </g>

              <g class="zeb-pin" tabindex="0" role="button"
                 aria-label="Ville : Abéché"
                 data-type="city"
                 data-city="Abéché"
                 data-note="Ville historique et carrefour commercial de l’est."
                 data-lat="13.8330" data-lng="20.8330"
                 data-gmaps="https://www.google.com/maps?q=13.833,20.833">
                <circle cx="360" cy="300" r="7"></circle>
              </g>

              <g class="zeb-pin" tabindex="0" role="button"
                 aria-label="Ville : Kélo"
                 data-type="city"
                 data-city="Kélo"
                 data-note="Ville agricole dynamique, connue pour le coton."
                 data-lat="9.3080" data-lng="15.8060"
                 data-gmaps="https://www.google.com/maps?q=9.308,15.806">
                <circle cx="160" cy="505" r="7"></circle>
              </g>

              <g class="zeb-pin" tabindex="0" role="button"
                 aria-label="Ville : Doba"
                 data-type="city"
                 data-city="Doba"
                 data-note="Zone pétrolière stratégique."
                 data-lat="8.6500" data-lng="16.8500"
                 data-gmaps="https://www.google.com/maps?q=8.65,16.85">
                <circle cx="205" cy="560" r="7"></circle>
              </g>

              <g class="zeb-pin" tabindex="0" role="button"
                 aria-label="Ville : Mongo"
                 data-type="city"
                 data-city="Mongo"
                 data-note="Ville centrale, commerce régional."
                 data-lat="12.1830" data-lng="18.7000"
                 data-gmaps="https://www.google.com/maps?q=12.183,18.7">
                <circle cx="285" cy="400" r="7"></circle>
              </g>

              <g class="zeb-pin" tabindex="0" role="button"
                 aria-label="Ville : Pala"
                 data-type="city"
                 data-city="Pala"
                 data-note="Ville frontalière, échanges commerciaux."
                 data-lat="9.3500" data-lng="14.9000"
                 data-gmaps="https://www.google.com/maps?q=9.35,14.9">
                <circle cx="125" cy="520" r="7"></circle>
              </g>
            </svg>

            <div class="zeb-map__hint" aria-hidden="true">Survolez ou cliquez une ville</div>
          </div>

          <aside class="zeb-panel" aria-live="polite">
            <div class="zeb-panel__card">
              <div class="zeb-panel__top">
                <div class="zeb-panel__badge">Zone d’intervention</div>
                <div class="zeb-panel__city" id="zebCityName">—</div>
                <div class="zeb-panel__note" id="zebCityNote">Survolez une ville pour afficher les informations.</div>
              </div>

              <div class="zeb-panel__rows">
                <div class="zeb-row">
                  <div class="zeb-row__k">Agence</div>
                  <div class="zeb-row__v">VPC Expert — N’Djamena</div>
                </div>
                <div class="zeb-row">
                  <div class="zeb-row__k">Adresse</div>
                  <div class="zeb-row__v">433F+VP N’Djamena, Tchad</div>
                </div>
                <div class="zeb-row zeb-row--strong">
                  <div class="zeb-row__k">Distance agence ⇄ ville</div>
                  <div class="zeb-row__v" id="zebAgencyToCity">—</div>
                </div>
                <div class="zeb-row">
                  <div class="zeb-row__k">Distance depuis votre position</div>
                  <div class="zeb-row__v" id="zebUserToAgency">Non disponible</div>
                </div>
                <div class="zeb-row">
                  <div class="zeb-row__k">Votre position ⇄ ville</div>
                  <div class="zeb-row__v" id="zebUserToCity">Non disponible</div>
                </div>
              </div>

              <div class="zeb-panel__actions">
                <button class="zeb-btn zeb-btn--primary" id="zebGeoBtn" type="button">Comparer ma position</button>
                <a class="zeb-btn zeb-btn--ghost" id="zebOpenAgency" target="_blank" rel="noopener">Ouvrir l’agence</a>
                <a class="zeb-btn zeb-btn--ghost" id="zebOpenCity" target="_blank" rel="noopener" aria-disabled="true">Ouvrir la ville</a>
              </div>
            </div>
          </aside>
        </div>
      </div>
    </section>

    <?php
    return ob_get_clean();
}
add_shortcode('interactive_service_map', 'wism_render_service_map');