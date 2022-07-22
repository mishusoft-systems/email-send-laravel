// External dependencies
import React from 'react';
import {Head} from '@inertiajs/inertia-react';

// Internal dependencies
import Authenticated from '@/Layouts/Authenticated';

export default function Dashboard(props) {

    console.log(props)

    return (
        <Authenticated auth={props.auth} errors={props.errors}
                       header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Events</h2>}>
            <Head title="Events"/>


            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="overflow-x-auto relative shadow-md sm:rounded-lg bg-white">

                        <div className="lg:flex lg:items-center lg:justify-between  sm:px-6 lg:px-8 sm:py-6 lg:py-8">
                            <div className="flex-1 min-w-0">
                                <p className="text-sm font-normal leading-7 text-gray-900 sm:text-sm sm:truncate">
                                    All events of our system
                                </p>
                            </div>
                            <div className="mt-5 flex lg:mt-0 lg:ml-4">
                                <span className="sm:ml-3">
                                    <button type="button" className="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        <svg className="-ml-1 mr-2 h-5 w-5 text-white-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                                        </svg>
                                        Add Event
                                    </button>
                                </span>
                            </div>
                        </div>

                        <table className="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead
                                className="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" className="py-3 px-6">#</th>
                                <th scope="col" className="py-3 px-6">title</th>
                                <th scope="col" className="py-3 px-6">
                                    <div className="flex items-center">
                                        Description
                                        <a href="#">
                                            <svg xmlns="http://www.w3.org/2000/svg" className="ml-1 w-3 h-3"
                                                 aria-hidden="true" fill="currentColor" viewBox="0 0 320 512">
                                                <path
                                                    d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/>
                                            </svg>
                                        </a>
                                    </div>
                                </th>
                                <th scope="col" className="py-3 px-6">
                                    <div className="flex items-center">
                                        Venue
                                        <a href="#">
                                            <svg xmlns="http://www.w3.org/2000/svg" className="ml-1 w-3 h-3"
                                                 aria-hidden="true" fill="currentColor" viewBox="0 0 320 512">
                                                <path
                                                    d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/>
                                            </svg>
                                        </a>
                                    </div>
                                </th>
                                <th scope="col" className="py-3 px-6">
                                    <span className="sr-only">Edit</span>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            {props.events.map((event) => (
                                <tr key={event.id} className="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td className="py-4 px-6">{event.id}</td>
                                    <td className="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">{event.title}</td>
                                    <td className="py-4 px-6">{event.description}</td>
                                    <td className="py-4 px-6">{event.venue}</td>
                                    <td className="py-4 px-6 text-right">
                                        <a href="#"
                                           className="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                    </td>
                                </tr>
                            ))}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </Authenticated>
    );
}
