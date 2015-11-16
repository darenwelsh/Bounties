<?php

class SpecialBounties extends SpecialPage {

	public $mMode;

	public function __construct() {
		parent::__construct(
			"Bounties", //
			"",  // rights required to view
			true // show in Special:SpecialPages
		);
	}

	function execute( $parser = null ) {
		global $wgRequest, $wgOut;

		list( $limit, $offset ) = wfCheckLimits();

		// $userTarget = isset( $parser ) ? $parser : $wgRequest->getVal( 'username' );
		$this->mMode = $wgRequest->getVal( 'show' );
		//$fileactions = array('actions...?');

		$wgOut->addHTML( $this->getPageHeader() );

		if ( $this->mMode == 'unique-user-data' ) {
			$this->uniqueTotals( true );
		}
		else {
			$this->bountiesList();
		}
	}

	public function getPageHeader() {
		global $wgRequest;

		// show the names of the different views
		$navLine = '<strong>' . wfMsg( 'bounties-viewmode' ) . ':</strong> ';

		$filterUser = $wgRequest->getVal( 'filterUser' );
		$filterPage = $wgRequest->getVal( 'filterPage' );

		if ( $filterUser || $filterPage ) {

			$BountiesTitle = SpecialPage::getTitleFor( 'Bounties' );
			$unfilterLink = ': (' . Xml::element( 'a',
				array( 'href' => $BountiesTitle->getLocalURL() ),
				wfMsg( 'bounties-unfilter' )
			) . ')';

		}
		else {
			$unfilterLink = '';
		}

		$navLine .= "<ul>";

		$navLine .= "<li>" . $this->createHeaderLink( 'bounties-bounties' ) . $unfilterLink . "</li>";

		$navLine .= "<li>"
			. ": (" . $this->createHeaderLink( 'unique-user-data' )
			. ")</li>";

		$navLine .= "</ul>";

		$out = Xml::tags( 'p', null, $navLine ) . "\n";

		return $out;
	}

	function createHeaderLink($msg, $query_param = '' ) {

		$BountiesTitle = SpecialPage::getTitleFor( 'Bounties' );

		if ( $this->mMode == $query_param ) {
			return Xml::element( 'strong',
				null,
				wfMsg( $msg )
			);
		} else {
			return Xml::element( 'a',
				array( 'href' => $BountiesTitle->getLocalURL( array( 'show' => $query_param ) ) ),
				wfMsg( $msg )
			);
		}

	}

	public function bountiesList () {
		global $wgOut, $wgRequest;

		$wgOut->setPageTitle( 'Bounties' );

		// $pager = new BountiesPager();
		// $pager->filterUser = $wgRequest->getVal( 'filterUser' );
		// $pager->filterPage = $wgRequest->getVal( 'filterPage' );

		// $form = $pager->getForm();
		// $body = $pager->getBody();
		$html = '';
		// $html = $form;
		if ( true ) {
			// $html .= $pager->getNavigationBar();
			$html .= '<table class="wikitable sortable" width="100%" cellspacing="0" cellpadding="0">';
			$html .= '<tr><th>Username</th><th>Page</th><th>Time</th><th>Referal Page</th></tr>';
			// $html .= $body;
			$html .= '<tr><td>' . wfMsgHTML('bounties-yes') . '</td><td></td><td></td><td></td></tr>';
			$html .= '</table>';
			// $html .= $pager->getNavigationBar();
		}
		else {
			$html .= '<p>' . wfMsgHTML('bounties-no') . '</p>';
		}
		$wgOut->addHTML( $html );
	}

}
