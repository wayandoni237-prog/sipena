<?php

session_start();
// cek login, kalo belum login lempar ke halaman login

if (!isset($_SESSION['username'])) {
  header("Location: login.php?pesan=belum_login");
  exit();
}

// koneksi database
include('../koneksi.php');
?>

<!doctype html>
<html lang="en">
<!--begin::Head-->

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>AdminLTE v4 | Dashboard</title>

  <!-- Anti Flash Tema (biar gak kedip pas ganti dark/light) -->
  <script>
    (() => {
      'use strict';
      const STORAGE_KEY = 'lte-theme';
      let stored = null;
      try {
        stored = localStorage.getItem(STORAGE_KEY);
      } catch {
        // localStorage may be unavailable (private mode, sandboxed iframe).
      }
      const prefersDark = globalThis.matchMedia('(prefers-color-scheme: dark)').matches;
      // Mirror the resolution in _scripts.astro: explicit "dark"/"light" win,
      // otherwise ("auto" or unset) fall back to the OS preference.
      let resolved = 'light';
      if (stored === 'dark' || stored === 'light') {
        resolved = stored;
      } else if (prefersDark) {
        resolved = 'dark';
      }
      document.documentElement.setAttribute('data-bs-theme', resolved);
      document.documentElement.style.colorScheme = resolved;
    })();
  </script>

  <!-- Meta Tag -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
  <meta name="color-scheme" content="light dark" />
  <meta name="theme-color" content="#007bff" media="(prefers-color-scheme: light)" />
  <meta name="theme-color" content="#1a1a1a" media="(prefers-color-scheme: dark)" />
  <meta name="supported-color-schemes" content="light dark" />
  <link rel="preload" href="./assets/css/adminlte.min.css" as="style" />

  <!-- Font -->
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
    integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q="
    crossorigin="anonymous"
    media="print"
    onload="this.media = 'all'" />

  <!-- Scrollbar Sidebar -->
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css"
    crossorigin="anonymous" />

  <!-- Icon -->
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
    crossorigin="anonymous" />

  <!-- CSS AdminLTE -->
  <link rel="stylesheet" href="./assets/css/adminlte.min.css" />

  <!-- Chart -->
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css"
    integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0="
    crossorigin="anonymous" />

  <!-- Peta Dunia -->
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/css/jsvectormap.min.css"
    integrity="sha256-+uGLJmmTKOqBr+2E6KDYs/NRsHxSkONXFHUL0fy2O/4="
    crossorigin="anonymous" />

  <!-- Sweet Alert -->
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.26.25/dist/sweetalert2.min.css" rel="stylesheet">

  <!-- DataTables -->
  <link
    rel="stylesheet"
    href="https://cdn.datatables.net/3.0.2/css/dataTables.dataTables.min.css"
    integrity="sha256-+uGLJmmTKOqBr+2E6KDYs/NRsHxSkONXFHUL0fy2O/4="
    crossorigin="anonymous" />

  <!-- DataTables Buttons -->
  <link
    rel="stylesheet"
    href="https://cdn.datatables.net/buttons/4.0.2/css/buttons.dataTables.min.css"
    integrity="sha256-+uGLJmmTKOqBr+2E6KDYs/NRsHxSkONXFHUL0fy2O/4="
    crossorigin="anonymous" />

  <!-- CSS gabungan DataTables + tema Bootstrap (yang bikin tampilan tabelnya nyambung sama Bootstrap) -->
  <link href="https://cdn.datatables.net/v/dt/dt-3.0.2/datatables.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/buttons/4.0.2/css/buttons.dataTables.min.css" rel="stylesheet">
  <link rel="https://cdn.datatables.net/3.0.2/css/dataTables.dataTables.min.css" href="stylesheet">
  <link rel="https://cdn.datatables.net/buttons/4.0.2/css/buttons.dataTables.min.css" href="stylesheet">
</head>
<!--end::Head-->
<!--begin::Body-->

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
  <!--begin::App Wrapper-->
  <div class="app-wrapper">

    <!-- Navbar Atas -->
    <nav class="app-header navbar navbar-expand bg-body">
      <div class="container-fluid">

        <!-- Tombol Buka/Tutup Sidebar -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a
              class="nav-link"
              data-lte-toggle="sidebar"
              href="#"
              role="button"
              aria-label="Toggle sidebar">
              <i class="bi bi-list"></i>
            </a>
          </li>
        </ul>

        <ul class="navbar-nav ms-auto">

          <!-- Tombol Fullscreen -->
          <li class="nav-item">
            <a
              class="nav-link"
              href="#"
              data-lte-toggle="fullscreen"
              aria-label="Toggle fullscreen">
              <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
              <i data-lte-icon="minimize" class="bi bi-fullscreen-exit d-none"></i>
            </a>
          </li>

          <!-- Toggle Tema (Light/Dark/Auto) -->
          <li class="nav-item dropdown">
            <a
              class="nav-link"
              href="#"
              id="bd-theme"
              aria-label="Toggle color scheme"
              data-bs-toggle="dropdown"
              aria-expanded="false">
              <i class="bi bi-sun-fill" data-lte-theme-icon="light"></i>
              <i class="bi bi-moon-fill d-none" data-lte-theme-icon="dark"></i>
              <i class="bi bi-circle-half d-none" data-lte-theme-icon="auto"></i>
            </a>
            <ul
              class="dropdown-menu dropdown-menu-end"
              aria-labelledby="bd-theme"
              style="--bs-dropdown-min-width: 8rem">
              <li>
                <button
                  type="button"
                  class="dropdown-item d-flex align-items-center"
                  data-bs-theme-value="light"
                  aria-pressed="false">
                  <i class="bi bi-sun-fill me-2"></i>
                  Light
                  <i class="bi bi-check-lg ms-auto d-none"></i>
                </button>
              </li>
              <li>
                <button
                  type="button"
                  class="dropdown-item d-flex align-items-center"
                  data-bs-theme-value="dark"
                  aria-pressed="false">
                  <i class="bi bi-moon-fill me-2"></i>
                  Dark
                  <i class="bi bi-check-lg ms-auto d-none"></i>
                </button>
              </li>
              <li>
                <button
                  type="button"
                  class="dropdown-item d-flex align-items-center active"
                  data-bs-theme-value="auto"
                  aria-pressed="true">
                  <i class="bi bi-circle-half me-2"></i>
                  Auto
                  <i class="bi bi-check-lg ms-auto d-none"></i>
                </button>
              </li>
            </ul>
          </li>

          <!-- Menu User (nama, role, tombol logout) -->
          <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
              <span class="d-none d-md-inline"><?= $_SESSION['username'] ?></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
              <li class="user-header text-bg-primary">
                <p>
                  <?= $_SESSION['nama_lengkap'] ?>
                  <small><?= $_SESSION['role'] ?></small>
                   <img
         src="assets/img/logo.jpeg" width="100" height="100" />
                </p>
              </li>
              <li class="user-footer">
                <a href="logout.php" class="btn btn-outline-danger float-end">Sign out</a>
              </li>
            </ul>
          </li>

        </ul>
      </div>
    </nav>
    <!--end::Header-->

    <!-- Sidebar (menu kiri, dipisah file sendiri) -->
    <?php include('sidebar.php'); ?>

    <!-- Konten Utama (isinya beda-beda tiap halaman) -->
    <?php include('konten.php'); ?>

    <!-- Footer -->
    <footer class="app-footer">
      <div class="float-end d-none d-sm-inline">Anything you want</div>
      <strong>
        Copyright &copy; 2026-2030&nbsp;
        <a href="https://sipena.gt.tc/admin" class="text-decoration-none">Admin_SiPena</a>.
      </strong>
      All rights reserved.
    </footer>
  </div>
  <!--end::App Wrapper-->

  <!-- Scrollbar Sidebar -->
  <script
    src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js"
    crossorigin="anonymous"></script>

  <!-- Popper (wajib buat dropdown/tooltip Bootstrap) -->
  <script
    src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    crossorigin="anonymous"></script>

  <!-- Bootstrap 5 -->
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js"
    crossorigin="anonymous"></script>

  <!-- AdminLTE -->
  <script src="./assets/js/adminlte.min.js"></script>

  <!-- Setting Scrollbar Sidebar -->
  <script>
    const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
    const Default = {
      scrollbarTheme: 'os-theme-light',
      scrollbarAutoHide: 'leave',
      scrollbarClickScroll: true,
    };
    document.addEventListener('DOMContentLoaded', function() {
      const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);

      // Disable OverlayScrollbars on mobile devices to prevent touch interference
      const isMobile = window.innerWidth <= 992;

      if (
        sidebarWrapper &&
        OverlayScrollbarsGlobal?.OverlayScrollbars !== undefined &&
        !isMobile
      ) {
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

  <!-- Toggle Tema: logicnya udah bawaan adminlte.js, gak perlu script tambahan -->

  <!-- Drag Card -->
  <script
    src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"
    crossorigin="anonymous"></script>
  <script>
    const sortableEl = document.querySelector('.connectedSortable');
    if (sortableEl) {
      new Sortable(sortableEl, {
        group: 'shared',
        handle: '.card-header',
      });
      const cardHeaders = document.querySelectorAll('.connectedSortable .card-header');
      cardHeaders.forEach((cardHeader) => {
        cardHeader.style.cursor = 'move';
      });
    }
  </script>

  <!-- Chart -->
  <script
    src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js"
    integrity="sha256-+vh8GkaU7C9/wbSLIcwq82tQ2wTf44aOHA8HlBMwRI8="
    crossorigin="anonymous"></script>
  <script>
    // Legacy demo chart — only render if container exists
    const revenueChartEl = document.querySelector('#revenue-chart');
    if (revenueChartEl) {
      const sales_chart_options = {
        series: [{ name: 'Digital Goods', data: [28, 48, 40, 19, 86, 27, 90] }, { name: 'Electronics', data: [65, 59, 80, 81, 56, 55, 40] }],
        chart: { height: 300, type: 'area', toolbar: { show: false } },
        legend: { show: false },
        colors: ['#0d6efd', '#20c997'],
        dataLabels: { enabled: false },
        stroke: { curve: 'smooth' },
        xaxis: { type: 'datetime', categories: ['2023-01-01','2023-02-01','2023-03-01','2023-04-01','2023-05-01','2023-06-01','2023-07-01'] },
        tooltip: { x: { format: 'MMMM yyyy' } },
      };
      new ApexCharts(revenueChartEl, sales_chart_options).render();
    }
  </script>

  <!-- Peta Dunia -->
  <script
    src="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/js/jsvectormap.min.js"
    integrity="sha256-/t1nN2956BT869E6H4V1dnt0X5pAQHPytli+1nTZm2Y="
    crossorigin="anonymous"></script>
  <script
    src="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/maps/world.js"
    integrity="sha256-XPpPaZlU8S/HWf7FZLAncLg2SAkP8ScUTII89x9D3lY="
    crossorigin="anonymous"></script>
  <script>
    // World map — only render if container exists
    const worldMapEl = document.querySelector('#world-map');
    if (worldMapEl) {
      new jsVectorMap({ selector: '#world-map', map: 'world' });
    }

    // Sparklines — only render if container exists
    function renderSparkline(selector, data, color) {
      const el = document.querySelector(selector);
      if (!el) return;
      new ApexCharts(el, {
        series: [{ data: data }],
        chart: { type: 'area', height: 50, sparkline: { enabled: true } },
        stroke: { curve: 'straight' },
        fill: { opacity: 0.3 },
        yaxis: { min: 0 },
        colors: [color],
      }).render();
    }

    renderSparkline('#sparkline-1', [1000, 1200, 920, 927, 931, 1027, 819, 930, 1021], '#DCE6EC');
    renderSparkline('#sparkline-2', [515, 519, 520, 522, 652, 810, 370, 627, 319, 630, 921], '#DCE6EC');
    renderSparkline('#sparkline-3', [15, 19, 20, 22, 33, 27, 31, 27, 19, 30, 21], '#DCE6EC');
  </script>

  <!-- Sweet Alert -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.26.25/dist/sweetalert2.all.min.js"></script>

  <!-- Notif Berhasil Simpan -->
  <script>
    <?php
    if (isset($_GET['pesan']) && $_GET['pesan'] == 'berhasil') { ?>
      Swal.fire({
        icon: "success",
        title: "Berhasil",
        text: "Data Berhasil di simpan!",
      });
    <?php }
    ?>
  </script>

  <!-- Notif Berhasil Update -->
  <script>
    <?php
    if (isset($_GET['pesan']) && $_GET['pesan'] == 'edit') { ?>
      Swal.fire({
        icon: "success",
        title: "Update",
        text: "Data Berhasil di update!",
      });
    <?php }
    ?>
  </script>

  <!-- Notif Berhasil Hapus -->
  <script>
    <?php
    if (isset($_GET['pesan']) && $_GET['pesan'] == 'hapus') { ?>
      Swal.fire({
        icon: "success",
        title: "Deleted",
        text: "Data Berhasil dihapus!",
      });
    <?php }
    ?>
  </script>

  <!-- DataTables -->
  <script src="https://cdn.datatables.net/3.0.2/js/dataTables.min.js"></script>

  <!-- DataTables Buttons -->
  <script src="https://cdn.datatables.net/buttons/4.0.2/js/dataTables.buttons.min.js"></script>

  <!-- Buttons Core -->
  <script src="https://cdn.datatables.net/buttons/4.0.2/js/buttons.dataTables.min.js"></script>

  <!-- Untuk Excel -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

  <!-- Untuk PDF -->
  <script src="https://cdn.jsdelivr.net/npm/pdfmake@0.3.11/build/pdfmake.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/pdfmake@0.3.11/build/vfs_fonts.js"></script>

  <!-- Tombol Export (Copy, Excel, CSV, PDF) di tabel id="usertabel" -->
  <script>
    const userTableEl = document.querySelector('#usertabel');
    if (userTableEl) {
      new DataTable('#usertabel', {
        layout: {
          topStart: {
            buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5']
          }
        }
      });
    }
  </script>

</body>
<!--end::Body-->

</html>