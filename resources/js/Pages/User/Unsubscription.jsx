// External dependencies
import React from 'react';
import {Head} from '@inertiajs/inertia-react';

// Internal dependencies
import Guest from "@/Layouts/Guest";

export default (props) => {

    return (
        <Guest>
            <Head title="Unsubscription"/>

            <div className="text-sm text-gray-600">
                Dear Customer, You are successfully opt out from subscription.
            </div>
        </Guest>
    );
}
