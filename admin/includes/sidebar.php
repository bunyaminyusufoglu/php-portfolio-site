<nav class="app-header navbar navbar-expand bg-body">
        <div class="container-fluid">
          <ul class="navbar-nav">
            <li class="nav-item d-none d-md-block"><a href="dashboard.php" class="nav-link">Ana Sayfa</a></li>
            <li class="nav-item d-none d-md-block"><a href="contact.php" class="nav-link">İletişim</a></li>
          </ul>
        </div>
</nav>
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
        <div class="sidebar-brand">
          <a href="dashboard.php" class="brand-link">
            <span class="brand-text fw-light">Yönetim Paneli</span>
          </a>
        </div>
        <div class="sidebar-wrapper">
          <nav class="mt-2">
            <ul
              class="nav sidebar-menu flex-column"
              data-lte-toggle="treeview"
              role="navigation"
              aria-label="Main navigation"
              data-accordion="false"
              id="navigation"
            >
              <li class="nav-item">
                <a href="dashboard.php" class="nav-link">
                  <i class="nav-icon bi bi-house"></i>
                  <p>Dashboard</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="about.php" class="nav-link">
                  <i class="nav-icon bi bi-person"></i>
                  <p>Hakkımda</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="projects.php" class="nav-link">
                  <i class="nav-icon bi bi-briefcase"></i>
                  <p>Projelerim</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="skills.php" class="nav-link">
                  <i class="nav-icon bi bi-tools"></i>
                  <p>Yeteneklerim</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./education.php" class="nav-link">
                  <i class="nav-icon bi bi-book"></i>
                  <p>Eğitimlerim</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="contact.php" class="nav-link">
                  <i class="nav-icon bi bi-envelope"></i>
                  <p>İletişim</p>
                </a>
              </li>
              <li class="nav-item">
              <a href="./settings.php" class="nav-link">
                <i class="nav-icon bi bi-gear"></i>
                <p>Ayarlar</p>
              </a>
              </li>
              <li class="nav-item">
              <a href="./logout.php" class="nav-link">
                <i class="nav-icon bi bi-box-arrow-in-right"></i>
                <p>Çıkış Yap</p>
              </a>
              </li>
            </ul>
            
          </nav>
        </div>
</aside>

<script
            src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js"
            crossorigin="anonymous"
></script>
<script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            crossorigin="anonymous"
></script>
<script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js"
            crossorigin="anonymous"
></script>
<script>
            const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
            const Default = {
            scrollbarTheme: 'os-theme-light',
            scrollbarAutoHide: 'leave',
            scrollbarClickScroll: true,
            };
            document.addEventListener('DOMContentLoaded', function () {
            const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
            if (sidebarWrapper && OverlayScrollbarsGlobal?.OverlayScrollbars !== undefined) {
                OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                scrollbars: {
                    theme: Default.scrollbarTheme,
                    autoHide: Default.scrollbarAutoHide,
                    clickScroll: Default.scrollbarClickScroll,
                },
                });
            }
            });
</script> 
<script>
            document.addEventListener('DOMContentLoaded', () => {
            const cssLink = document.querySelector('link[href*="css/adminlte.css"]');
            if (!cssLink) {
                return;
            }

            const cssHref = cssLink.getAttribute('href');
            const deploymentPath = cssHref.slice(0, cssHref.indexOf('css/adminlte.css'));

            document.querySelectorAll('img[src^="/assets/"]').forEach((img) => {
                const originalSrc = img.getAttribute('src');
                if (originalSrc) {
                const relativeSrc = originalSrc.slice(1);
                img.src = deploymentPath + relativeSrc;
                }
            });
            });
</script>
<script
            src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"
            crossorigin="anonymous"
></script>
<script>
            new Sortable(document.querySelector('.connectedSortable'), {
            group: 'shared',
            handle: '.card-header',
            });

            const cardHeaders = document.querySelectorAll('.connectedSortable .card-header');
            cardHeaders.forEach((cardHeader) => {
            cardHeader.style.cursor = 'move';
            });
</script>
<script
            src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js"
            integrity="sha256-+vh8GkaU7C9/wbSLIcwq82tQ2wTf44aOHA8HlBMwRI8="
            crossorigin="anonymous"
></script>
<script>
            const sales_chart_options = {
            series: [
                {
                name: 'Digital Goods',
                data: [28, 48, 40, 19, 86, 27, 90],
                },
                {
                name: 'Electronics',
                data: [65, 59, 80, 81, 56, 55, 40],
                },
            ],
            chart: {
                height: 300,
                type: 'area',
                toolbar: {
                show: false,
                },
            },
            legend: {
                show: false,
            },
            colors: ['#0d6efd', '#20c997'],
            dataLabels: {
                enabled: false,
            },
            stroke: {
                curve: 'smooth',
            },
            xaxis: {
                type: 'datetime',
                categories: [
                '2023-01-01',
                '2023-02-01',
                '2023-03-01',
                '2023-04-01',
                '2023-05-01',
                '2023-06-01',
                '2023-07-01',
                ],
            },
            tooltip: {
                x: {
                format: 'MMMM yyyy',
                },
            },
            };

            const sales_chart = new ApexCharts(
            document.querySelector('#revenue-chart'),
            sales_chart_options,
            );
            sales_chart.render();
</script>
<script
            src="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/js/jsvectormap.min.js"
            integrity="sha256-/t1nN2956BT869E6H4V1dnt0X5pAQHPytli+1nTZm2Y="
            crossorigin="anonymous"
></script>
<script
            src="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/maps/world.js"
            integrity="sha256-XPpPaZlU8S/HWf7FZLAncLg2SAkP8ScUTII89x9D3lY="
            crossorigin="anonymous"
></script>
<script>
            new jsVectorMap({
            selector: '#world-map',
            map: 'world',
            });

            const option_sparkline1 = {
            series: [
                {
                data: [1000, 1200, 920, 927, 931, 1027, 819, 930, 1021],
                },
            ],
            chart: {
                type: 'area',
                height: 50,
                sparkline: {
                enabled: true,
                },
            },
            stroke: {
                curve: 'straight',
            },
            fill: {
                opacity: 0.3,
            },
            yaxis: {
                min: 0,
            },
            colors: ['#DCE6EC'],
            };

            const sparkline1 = new ApexCharts(document.querySelector('#sparkline-1'), option_sparkline1);
            sparkline1.render();

            const option_sparkline2 = {
            series: [
                {
                data: [515, 519, 520, 522, 652, 810, 370, 627, 319, 630, 921],
                },
            ],
            chart: {
                type: 'area',
                height: 50,
                sparkline: {
                enabled: true,
                },
            },
            stroke: {
                curve: 'straight',
            },
            fill: {
                opacity: 0.3,
            },
            yaxis: {
                min: 0,
            },
            colors: ['#DCE6EC'],
            };

            const sparkline2 = new ApexCharts(document.querySelector('#sparkline-2'), option_sparkline2);
            sparkline2.render();

            const option_sparkline3 = {
            series: [
                {
                data: [15, 19, 20, 22, 33, 27, 31, 27, 19, 30, 21],
                },
            ],
            chart: {
                type: 'area',
                height: 50,
                sparkline: {
                enabled: true,
                },
            },
            stroke: {
                curve: 'straight',
            },
            fill: {
                opacity: 0.3,
            },
            yaxis: {
                min: 0,
            },
            colors: ['#DCE6EC'],
            };

            const sparkline3 = new ApexCharts(document.querySelector('#sparkline-3'), option_sparkline3);
            sparkline3.render();
</script>

<script src="../../assets/js/admin.js"></script>