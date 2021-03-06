<?php
/**
 * Copyright 2011 Bas de Nooijer. All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *
 * 1. Redistributions of source code must retain the above copyright notice,
 *    this list of conditions and the following disclaimer.
 *
 * 2. Redistributions in binary form must reproduce the above copyright notice,
 *    this listof conditions and the following disclaimer in the documentation
 *    and/or other materials provided with the distribution.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDER AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * The views and conclusions contained in the software and documentation are
 * those of the authors and should not be interpreted as representing official
 * policies, either expressed or implied, of the copyright holder.
 *
 * @copyright Copyright 2011 Bas de Nooijer <solarium@raspberry.nl>
 * @license http://github.com/basdenooijer/solarium/raw/master/COPYING
 * @link http://www.solarium-project.org/
 *
 * @package Solarium
 * @subpackage Query
 */

/**
 * Filterquery
 *
 * @link http://wiki.apache.org/solr/CommonQueryParameters#fq
 *
 * @package Solarium
 * @subpackage Query
 */
class Solarium_Query_Select_FilterQuery extends Solarium_Configurable
{

    /**
     * Tags for this filterquery
     *
     * @var array
     */
    protected $_tags = array();

    /**
     * Query
     *
     * @var string
     */
    protected $_query;

    /**
     * Initialize options
     *
     * @return void
     */
    protected function _init()
    {
        foreach ($this->_options AS $name => $value) {
            switch ($name) {
                case 'tag':
                    if(!is_array($value)) $value = array($value);
                    $this->addTags($value);
                    break;
                case 'key':
                    $this->setKey($value);
                    break;
                case 'query':
                    $this->setQuery($value);
                    break;
            }
        }
    }

    /**
     * Get key value
     *
     * @return string
     */
    public function getKey()
    {
        return $this->getOption('key');
    }

    /**
     * Set key value
     *
     * @param string $value
     * @return Solarium_Query_Select_FilterQuery Provides fluent interface
     */
    public function setKey($value)
    {
        return $this->_setOption('key', $value);
    }

    /**
     * Set the query string
     *
     * This overwrites the current value
     *
     * @param string $query
     * @return Solarium_Query Provides fluent interface
     */
    public function setQuery($query)
    {
        $this->_query = trim($query);
        return $this;
    }

    /**
     * Get the query string
     *
     * @return string
     */
    public function getQuery()
    {
        return $this->_query;
    }

    /**
     * Add a tag
     *
     * @param string $tag
     * @return Solarium_Query_Select_FilterQuery Provides fluent interface
     */
    public function addTag($tag)
    {
        $this->_tags[$tag] = true;
        return $this;
    }

    /**
     * Add tags
     *
     * @param array $tags
     * @return Solarium_Query_Select_FilterQuery Provides fluent interface
     */
    public function addTags($tags)
    {
        foreach ($tags AS $tag) {
            $this->addTag($tag);
        }
        return $this;
    }

    /**
     * Get all tagss
     *
     * @return array
     */
    public function getTags()
    {
        return array_keys($this->_tags);
    }

    /**
     * Remove a tag
     *
     * @param string $tag
     * @return Solarium_Query_Select_FilterQuery Provides fluent interface
     */
    public function removeTag($tag)
    {
        if (isset($this->_tags[$tag])) {
            unset($this->_tags[$tag]);
        }

        return $this;
    }

    /**
     * Remove all tags
     *
     * @return Solarium_Query_Select_FilterQuery Provides fluent interface
     */
    public function clearTags()
    {
        $this->_tags = array();
        return $this;
    }

    /**
     * Set multiple tags
     *
     * This overwrites any existing tags
     *
     * @param array $filterQueries
     * @return Solarium_Query_Select_FilterQuery Provides fluent interface
     */
    public function setTags($filterQueries)
    {
        $this->clearTags();
        return $this->addTags($filterQueries);
    }

}