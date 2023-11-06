<?php helper('my_numbers') ?>
<!--begin::Content-->

<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Toolbar-->
    <div class="toolbar" id="kt_toolbar">
        <!--begin::Toolbar-->
        <div class="toolbar" id="kt_toolbar">
            <!--begin::Container-->
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                <!--begin::Page title-->
                <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                    data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                    class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                    <!--begin::Title-->
                    <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1"><?=$title?>
                        <!--begin::Separator-->
                        <span class="h-20px border-1 border-gray-200 border-start ms-3 mx-2 me-1"></span>
                        <!--end::Separator-->
                    </h1>
                    <!--end::Title-->
                </div>
                <!--end::Page title-->

            </div>
            <!--end::Container-->
        </div>
        <!--end::Toolbar-->
    </div>
    <!--end::Toolbar-->
    <!--begin::Post-->
    <div class="post flex-column-fluid" id="kt_post">
        <div class="card mb-5 mb-xl-8">
            <?php if (!empty(session()->getFlashdata('error'))) : ?>
            <div class="alert alert-danger" role="alert">
                <h4>Periksa Entrian Form</h4>
                </hr />
                <?php echo session()->getFlashdata('error'); ?>
            </div>
            <?php endif; ?>
            <?php if (!empty(session()->getFlashdata('success'))) : ?>
            <div class="alert alert-success" role="alert">
                <?php echo session()->getFlashdata('success'); ?>
            </div>
            <?php endif; ?>
            <!--begin::Header-->
            <div class="card-header border-0 pt-5">
               
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body py-3">
                <!--begin::Table container-->
                <div class="table-responsive">
                    <!--begin::Table-->
                    <table class="table align-middle gs-0 gy-4">
                        <!--begin::Table head-->
                        <thead>
                            <tr class="fw-bolder text-muted bg-light">
                                <th>Tanggal</th>
                                <th  class="min-w-550px">Deskripsi</th>
                                <th>Jenis</th>
                                <th>Kategori</th>
                                <th>Nominal</th>
                                <th>Valid</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody>
                            <?php foreach($list as $key => $value) : ?>
                            <?php
                                    if($value['is_valid'] == 0)
                                    {
                                        $valid = '<span class="badge bg-success badge-lg">VALID</span>';
                                    }elseif($value['is_valid'] == 1)
                                    {
                                        $valid = '<span class="badge bg-danger badge-lg">TIDAK VALID</span>';
                                    }elseif($value['is_valid'] == 2)
                                    {
                                        $valid = '<span class="badge bg-warning badge-lg">PERLU DIVERIFIKASI</span>';
                                    }

                            ?>
                            <!-- SELECT `id_transaksi`, ``, ``, ``, ``, ``, ``, `` FROM `laporan_transaksi` WHERE 1 -->
                            <tr class="fw-bolder text-muted bg-light">
                                <td><?= $value['tanggal_transaksi'] ?></td>
                                <td><?= $value['deskripsi'] ?></td>
                                <td><?= $value['jenis_transaksi'] ?></td>
                                <td><?= $value['kategori_transaksi'] ?></td>
                                <td><?= $value['nominal'] ?></td>
                                <td><?= $valid ?></td>
                                <td>
                                    <?php if($value['is_valid'] == 2){ ?>
                                    <a class="btn btn-success btn-sm"
                                        href="<?= base_url('transaksi/update_valid/') . $value['id_transaksi'] ?>/0">VALID</a>
                                    <a class="btn btn-danger btn-sm"
                                        href="<?= base_url('transaksi/update_valid/') . $value['id_transaksi'] ?>/1">TIDAK
                                        VALID</a>
                                    <?php   } ?>
                                </td>
                            </tr>

                            <?php endforeach; ?>
                        </tbody>
                        <!--end::Table body-->
                    </table>
                    <!--end::Table-->
                </div>
                <!--end::Table container-->
            </div>
            <!--begin::Body-->
        </div>
    </div>
</div>
<!--end::Content-->
