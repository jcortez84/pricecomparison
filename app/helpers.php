<?php

    /**
     * Method that strips strings of non-alphanumeric 
     * characters and turn them into a slug
     * @param $string
     * 
     * @return $slug
     */
    function makeSlug($string)
    {
        return preg_replace('#\s+#','-',strtolower(preg_replace("/[^A-Za-z0-9 ]/", '', $string)));
    }

    /**
     * Get the categories bread crumb
     */
     
    function makeBreadCrumb($id)
    {
        $cat = App\Category::find($id);
        if(Request()->slug === $cat->slug){
            $breadcrumb = "<li class='breadcrumb-item  active'  aria-current='page'>$cat->title</li>";
        }else{
            $breadcrumb = "<li class='breadcrumb-item'><a  class='text-dark' href='/c/$cat->slug'>$cat->title</a></li>";
        }
        
        if($cat->parent_id !== 0){
           makeBreadCrumb($cat->parent_id);

        }
        print($breadcrumb);
    }

    /**
     * Get the 
     */
    function getMerchant($id)
    {
        $merchant = App\Merchant::find($id);
        return $merchant->name;
    }

    /**
     * Get remote file for processing
     */
    function getRemoteFile($source, $destination)
    {
        set_time_limit(0);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $source);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $data = curl_exec ($ch);
        curl_close ($ch);

        $file = fopen($destination, "w+");
        fputs($file, $data);
        fclose($file);
    }