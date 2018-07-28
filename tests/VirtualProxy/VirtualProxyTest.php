<?php

class VirtualProxyTest extends PHPUnit\Framework\TestCase
{

    const TEST_IMAGE = __DIR__ . '/../../assets/images/big_image.jpg';

    /** @test */
    public function image_subject_get_correct_image_width_and_height()
    {
        $image = new ProxyPatterns\VirtualProxy\RealImageSubject(self::TEST_IMAGE); // image: ≈ 4.8MB
        $this->assertEquals($this->get_test_image_size(), $image->getSize());
    }

    private function get_test_image_size()
    {
        $img_properties = getimagesize(self::TEST_IMAGE);

        return ['width' => $img_properties[0], 'height' => $img_properties[1]];
    }

    /** @test */
    public function image_subject_consumes_memory_right_directly_after_creating_one_instance()
    {
        $first_memory = $this->memory_usage_in_mb();
        $image = new ProxyPatterns\VirtualProxy\RealImageSubject(self::TEST_IMAGE); // image: ≈ 4.8MB
        $second_memory = $this->memory_usage_in_mb();
        $memory_usage_of_image = $second_memory - $first_memory;

        $this->assertEquals($memory_usage_of_image, $this->get_test_file_size_in_mb());
        $this->assertEquals($this->get_test_image_size(), $image->getSize());
    }

    private function memory_usage_in_mb()
    {
        $mem_usage = memory_get_usage(true);
        return round($mem_usage / (1024 * 1024), 2);
    }

    private function get_test_file_size_in_mb()
    {
        $mem_usage = filesize(self::TEST_IMAGE);
        return round($mem_usage / (1024 * 1024), 2);
    }

    /** @test */
    public function image_subject_consumes_two_times_memory_after_creating_two_instances_of_the_image()
    {
        $first_memory = $this->memory_usage_in_mb();
        $image = new ProxyPatterns\VirtualProxy\RealImageSubject(__DIR__ . '/../../assets/images/big_image.jpg'); // image: ≈ 4.8MB, after: first_memory+image
        $second_memory = $this->memory_usage_in_mb();
        $image2 = new ProxyPatterns\VirtualProxy\RealImageSubject(__DIR__ . '/../../assets/images/big_image.jpg'); // image: ≈ 4.8MB, after: second_memory+image
        $third_memory = $this->memory_usage_in_mb();

        $memory_usage_of_image = $second_memory - $first_memory;
        $memory_usage_of_image_after_second_load = $third_memory - $second_memory;

        $this->assertEquals($memory_usage_of_image, $memory_usage_of_image_after_second_load);
        $this->assertEquals($memory_usage_of_image_after_second_load, $this->get_test_file_size_in_mb());
        $this->assertEquals($image->getSize(), $image2->getSize());
    }

    /** @test */
    public function image_proxy_get_correct_image_width_and_height()
    {
        $image = new ProxyPatterns\VirtualProxy\ImageProxy(self::TEST_IMAGE); // image: ≈ 4.8MB
        $this->assertEquals($this->get_test_image_size(), $image->getSize());
    }

    /** @test */
    public function image_proxy_doesnt_consumes_memory_right_directly_after_creating_one_instance()
    {
        $first_memory = $this->memory_usage_in_mb();
        $image = new ProxyPatterns\VirtualProxy\ImageProxy(self::TEST_IMAGE); // image: ≈ 4.8MB
        $second_memory = $this->memory_usage_in_mb();

        $this->assertEquals($second_memory, $first_memory);
        $this->assertEquals($this->get_test_image_size(), $image->getSize());
    }

    /** @test */
    public function image_proxy_only_consumes_memory_after_called_getSize_method()
    {
        $first_memory = $this->memory_usage_in_mb();
        $image = new ProxyPatterns\VirtualProxy\ImageProxy(self::TEST_IMAGE); // image: ≈ 4.8MB
        $second_memory = $this->memory_usage_in_mb();

        $this->assertEquals($second_memory, $first_memory);
        $this->assertEquals($this->get_test_image_size(), $image->getSize());

        $third_memory = $this->memory_usage_in_mb(); // image is actually loaded by $image->getSize() above
        $memory_usage_of_image = $third_memory - $second_memory;

        $this->assertEquals($memory_usage_of_image, $this->get_test_file_size_in_mb());
    }

}