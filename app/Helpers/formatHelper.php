<?php

if (!function_exists('formatCpf')) {
    function formatCpf($cpf)
    {
        // Remove qualquer formatação existente
        $cpf = preg_replace('/[^0-9]/', '', $cpf);
        // Formata CPF
        return preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $cpf);
    }
}

if (!function_exists('formatCep')) {
    function formatCep($cep)
    {
        // Remove qualquer formatação existente
        $cep = preg_replace('/[^0-9]/', '', $cep);
        // Formata CEP
        return preg_replace('/(\d{5})(\d{3})/', '$1-$2', $cep);
    }
}

if (!function_exists('formatPhone')) {
    function formatPhone($phone)
    {
        // Remove qualquer formatação existente
        $phone = preg_replace('/[^0-9]/', '', $phone);
        // Formata Telefone
        return preg_replace('/(\d{2})(\d{4,5})(\d{4})/', '($1) $2-$3', $phone);
    }
}

if (!function_exists('formatWhatsapp')) {
    function formatWhatsapp($whatsapp)
    {
        // Remove qualquer formatação existente
        $whatsapp = preg_replace('/[^0-9]/', '', $whatsapp);
        // Formata WhatsApp
        return preg_replace('/(\d{2})(\d{5})(\d{4})/', '($1) $2-$3', $whatsapp);
    }
}

if (!function_exists('formatCnpj')) {
    function formatCnpj($cnpj)
    {
        // Remove qualquer formatação existente
        $cnpj = preg_replace('/[^0-9]/', '', $cnpj);
        // Formata CNPJ
        return preg_replace('/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/', '$1.$2.$3/$4-$5', $cnpj);
    }
}

if (!function_exists('formatRg')) {
    function formatRg($rg)
    {
        // Remove qualquer formatação existente
        $rg = preg_replace('/[^0-9A-Za-z]/', '', $rg);
        return preg_replace('/(\d{2})(\d{3})(\d{3})([0-9A-Za-z]{1})/', '$1.$2.$3-$4', $rg);
    }
}