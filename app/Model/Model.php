<?php

interface Model{

    /**
     * Retorna um objeto a partir de um array
     *
     * @param array $array
     * @return Object
     */
    public static function toObject(array $array);
    /**
     * Transforma um objeto em um array com seus atributos
     *
     * @return array
     */
    public function toArray();
    /**
     * Carrega um objeto de determinada id
     *
     * @param integer $id
     * @return object
     */
    public static function load(int $id);
    /**
     * Carrega todos os objetos da classe
     *
     * @return array[object]
     */
    public static function loadAll();
    /**
     * Salva o objeto no banco de dados
     *
     * @return void
     */
    public function save();
    /**
     * Apaga o objeto do banco de dados
     *
     * @return void
     */
    public function delete();
    
}