<?php
/* Copyright (C) 2012 Regis Houssin <regis.houssin@capnetworks.com>
 * Copyright (C) 2014 Marcos García <marcosgdf@gmail.com>
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 *
 */
?>

<!-- BEGIN PHP TEMPLATE -->

<?php

global $user;

$langs = $GLOBALS['langs'];
$linkedObjectBlock = $GLOBALS['linkedObjectBlock'];

$langs->load("sendings");
echo '<br>';
print_titre($langs->trans('RelatedShippings'));

?>
<table class="noborder allwidth">
<tr class="liste_titre">
	<td><?php echo $langs->trans("Ref"); ?></td>
	<td align="center"><?php echo $langs->trans("Date"); ?></td>
	<td align="center"><?php echo $langs->trans("DateDeliveryPlanned"); ?></td>
	<td align="right"><?php echo $langs->trans("AmountHTShort"); ?></td>
	<td align="right"><?php echo $langs->trans("Status"); ?></td>
</tr>
<?php
$var=true;
foreach($linkedObjectBlock as $object)
{
	$var=!$var;
?>
<tr <?php echo $GLOBALS['bc'][$var]; ?> >
    <td><?php echo $object->getNomUrl(1); ?></td>
	<td align="center"><?php echo dol_print_date($object->date_creation,'day'); ?></td>
	<td align="center"><?php echo dol_print_date($object->date_delivery,'day'); ?></td>
	<td align="right"><?php
		if ($user->rights->expedition->lire) {
			$total = $total + $object->total_ht;
			echo price($object->total_ht);
		} ?></td>
	<td align="right"><?php echo $object->getLibStatut(3); ?></td>
</tr>
<?php
}

?>
<tr class="liste_total">
	<td align="left" colspan="3"><?php echo $langs->trans('TotalHT'); ?></td>
	<td align="right"><?php
		if ($user->rights->expedition->lire) {
			echo price($total);
		} ?></td>
	<td>&nbsp;</td>
</tr>
</table>

<!-- END PHP TEMPLATE -->