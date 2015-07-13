<?php

use app\Organisation;
use Illuminate\Database\Seeder;

/**
 * Class OrganisationTableSeeder
 */
class OrganisationTableSeeder extends Seeder
{

    protected static $organisations = [
        'scu' => [
            'name' => 'Save The Children Uganda',
            'mission' => 'Is to inspire breakthroughs in the way the world treats children, and to achieve immediate and lasting change in their lives.',
            'description' => 'Save the Children is the leading independent organization for children. Save the Children works to achieve children’s rights, particularly for the poorest and most marginalised, who are most at risk of their rights being denied. The principles, rights and obligations set out in The United Nations Convention on the Rights of the Child provide a framework for all our work.In Uganda we implement programmes in the six thematic programme areas of Child Protection, Child Rights Governance, Education, Livelihood and Food Security, Health and Nutrition and HIV/AIDS in development and emergency contexts.',
            'objectives' => '',
            'email' => 'info@scu.org.ug',
            'website' => 'https://uganda.savethechildren.net/',
            'phone' => '256414341714',
            'cc_phone' => '256414510582',
            'address' => 'Plot 68/70 Kira Road, P. O. Box 12018, Kampala, Uganda',
            'twitter' => '@savechildrenug',
            'facebook' => 'https://www.facebook.com/savethechildren.uganda.5'
        ],
        'fida' => [
            'name' => 'FIDA Uganda',
            'description' => 'FIDA (The Uganda Association of Women Lawyers) was established in 1974 by a group of women lawyers with the primary objective of promoting their professional and intellectual growth. FIDA Uganda established its first legal aid clinic in Kampala in 1988, with the objective of providing legal services to indigent women to enable them access justice.',
            'mission' => 'To promote the human rights and the inherent dignity of women and children using law as a tool of social justice.',
            'email' => 'fida@fidauganda.org',
            'website' => 'http://www.fidauganda.org',
            'phone' => '256414530848',
            'address' => 'Plot 11, Kanjokya Street, Kamwokya',
            'facebook' => 'https://www.facebook.com/FIDAUganda',
            'twitter' => '@FIDA_Uganda'
        ],
    ];

    public function run()
    {
        DB::table('organisations')->truncate();
        foreach (static::$organisations as $code => $org) {
            $org = Organisation::forceCreate($org);
            $org->slug = str_slug($org->name);
            $org->save();
        }
    }
}