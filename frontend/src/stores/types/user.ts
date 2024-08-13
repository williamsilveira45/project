/**
 * {
 *    "id": 1,
 *    "name": "William Silveira 20",
 *    "email": "will@will.com",
 *    "email_verified_at": null,
 *    "created_at": "2024-05-19T02:41:09.000000Z",
 *    "updated_at": "2024-05-29T03:18:32.000000Z"
 * }
 */
export interface User {
    id: number;
    name: string;
    email: string;
    email_verified_at: string | null;
    created_at: string;
    updated_at: string;
}
