// External dependencies
import React from 'react';
import {Head} from '@inertiajs/inertia-react';

// Internal dependencies
import Guest from "@/Layouts/Guest";

export default (props) => {

    return (
        <Guest>
            <Head title="Response"/>

            <div className="text-sm text-gray-600">
                Dear Customer, Thank you for response.
            </div>
        </Guest>
    );
}
