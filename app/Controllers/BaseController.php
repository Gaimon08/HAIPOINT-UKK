<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

use App\Models\MGSettings;
use App\Models\MUser;
use App\Models\MProduk;
use App\Models\MJproduk;
use App\Models\MSproduk;
use App\Models\MSupplier;
use App\Models\MPembelian;
use App\Models\MDPembelian;
use App\Models\MPenjualan;
use App\Models\MDPenjualan;
use App\Models\MLaporan;
use App\Models\DashboardModel;
use Myth\Auth\Models\UserModel;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;
    protected $general_settings;
    protected $user;
    protected $produk;
    protected $jenis_produk;
    protected $satuan_produk;
    protected $supplier;
    protected $pembelian;
    protected $detail_pembelian;
    protected $penjualan;
    protected $detail_penjualan;
    protected $laporan;
    protected $dashboard;
    protected $userMyth;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = [];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        //membuat instance dari class 
        $this->general_settings = new MGSettings();
        $this->user = new MUser;
        $this->produk = new MProduk;
        $this->jenis_produk = new MJProduk;
        $this->satuan_produk = new MSProduk;
        $this->supplier = new MSupplier();
        $this->pembelian = new MPembelian();
        $this->detail_pembelian = new MDPembelian();
        $this->penjualan = new MPenjualan();
        $this->detail_penjualan = new MDPenjualan();
        $this->laporan = new MLaporan();
        $this->dashboard = new DashboardModel();
        $this->userMyth = new UserModel();

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();
    }
}
