<?php

class ProductController extends Controller
{
    public function index()
    {
        if (!$this->requireLogin()) {
            return;
        }

        $productModel = $this->call->model('ProductModel');
        $this->renderIndex($productModel);
    }

    public function create()
    {
        if (!$this->requireLogin()) {
            return;
        }

        $this->call->view('product_form', [
            'product' => [],
            'error' => '',
            'formAction' => site_url('products/store'),
            'heading' => 'Add Product',
        ]);
    }

    public function store()
    {
        if (!$this->requireLogin()) {
            return;
        }

        $data = $this->validatedInput();
        if (isset($data['error'])) {
            $this->call->view('product_form', [
                'product' => $data['product'],
                'error' => $data['error'],
                'formAction' => site_url('products/store'),
                'heading' => 'Add Product',
            ]);
            return;
        }

        $this->call->model('ProductModel')->insert($data['product']);
        redirect('/products');
    }

    public function edit($id)
    {
        if (!$this->requireLogin()) {
            return;
        }

        $productModel = $this->call->model('ProductModel');
        $product = $productModel->find($id);
        if (!$product) {
            redirect('/products');
            return;
        }

        $this->call->view('product_form', [
            'product' => $product,
            'error' => '',
            'formAction' => site_url('products/update/' . $id),
            'heading' => 'Edit Product',
        ]);
    }

    public function update($id)
    {
        if (!$this->requireLogin()) {
            return;
        }

        $productModel = $this->call->model('ProductModel');
        $product = $productModel->find($id);
        if (!$product) {
            redirect('/products');
            return;
        }

        $data = $this->validatedInput();
        if (isset($data['error'])) {
            $data['product']['id'] = $id;
            $this->call->view('product_form', [
                'product' => $data['product'],
                'error' => $data['error'],
                'formAction' => site_url('products/update/' . $id),
                'heading' => 'Edit Product',
            ]);
            return;
        }

        $productModel->update($id, $data['product']);
        redirect('/products');
    }

    public function delete($id)
    {
        if (!$this->requireLogin()) {
            return;
        }

        $this->call->model('ProductModel')->delete($id);
        redirect('/products');
    }

    private function renderIndex($productModel, $error = '')
    {
        $this->call->view('products', [
            'products' => $productModel->all(),
            'error' => $error,
        ]);
    }

    private function validatedInput()
    {
        $product = [
            'product_name' => trim($_POST['product_name'] ?? ''),
            'description' => trim($_POST['description'] ?? ''),
            'price' => trim($_POST['price'] ?? ''),
            'quantity' => trim($_POST['quantity'] ?? ''),
        ];

        if ($product['product_name'] === '' || $product['price'] === '' || $product['quantity'] === '') {
            return ['product' => $product, 'error' => 'Product name, price, and quantity are required.'];
        }

        if (!is_numeric($product['price']) || (float) $product['price'] < 0) {
            return ['product' => $product, 'error' => 'Price must be a non-negative number.'];
        }

        if (filter_var($product['quantity'], FILTER_VALIDATE_INT) === false || (int) $product['quantity'] < 0) {
            return ['product' => $product, 'error' => 'Quantity must be a non-negative whole number.'];
        }

        $product['price'] = number_format((float) $product['price'], 2, '.', '');
        $product['quantity'] = (int) $product['quantity'];

        return ['product' => $product];
    }

    private function requireLogin()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        if (empty($_SESSION['user_id'])) {
            redirect('/login');
            return false;
        }

        return true;
    }
}
